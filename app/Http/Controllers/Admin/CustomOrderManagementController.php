<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CustomOrderManagementController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    /**
     * Display a listing of custom orders.
     */
    public function index(Request $request)
    {
        $query = CustomOrder::with(['user', 'product', 'size']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $customOrders = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = ['pending', 'review', 'design', 'production', 'shipped', 'completed', 'cancelled'];

        return view('admin.custom-orders.index', compact('customOrders', 'statuses'));
    }

    /**
     * Display the specified custom order.
     */
    public function show($id)
    {
        $customOrder = CustomOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.custom-orders.show', compact('customOrder'));
    }

    /**
     * Show the form for processing a custom order.
     */
    public function process($id)
    {
        $customOrder = CustomOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.custom-orders.process', compact('customOrder'));
    }

    /**
     * Update the specified custom order status.
     */
    public function update(Request $request, $id)
    {
        $customOrder = CustomOrder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,review,design,production,shipped,completed,cancelled',
            'price_quote' => 'nullable|numeric|min:0',
            'estimated_completion_date' => 'nullable|date|after:today',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'status' => $request->status,
            'admin_notes' => $request->notes,
        ];

        if ($request->has('price_quote') && $request->price_quote) {
            $data['price_quote'] = $request->price_quote;
        }

        if ($request->has('estimated_completion_date') && $request->estimated_completion_date) {
            $data['estimated_completion_date'] = $request->estimated_completion_date;
        }

        $customOrder->update($data);

        // Send notification
        $this->notificationService->sendCustomOrderStatusUpdate($customOrder);

        return redirect()->route('admin.custom-orders.show', $customOrder->id)
            ->with('success', 'Status custom order berhasil diperbarui!');
    }

    /**
     * Delete a custom order.
     */
    public function destroy($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        
        // Delete custom image
        if ($customOrder->custom_image) {
            Storage::disk('public')->delete($customOrder->custom_image);
        }

        $customOrder->delete();

        return redirect()->route('admin.custom-orders.index')
            ->with('success', 'Custom order berhasil dihapus!');
    }

    /**
     * Export custom orders to CSV.
     */
    public function export(Request $request)
    {
        $query = CustomOrder::with(['user', 'product', 'size']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $customOrders = $query->orderBy('created_at', 'desc')->get();

        $filename = 'custom-orders-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        // Header
        fputcsv($handle, [
            'Order Number',
            'Customer',
            'Product',
            'Size',
            'Quantity',
            'Status',
            'Price Quote',
            'Created At',
            'Estimated Completion'
        ]);

        // Data
        foreach ($customOrders as $customOrder) {
            fputcsv($handle, [
                $customOrder->order_number,
                $customOrder->user->name,
                $customOrder->product ? $customOrder->product->name : 'Custom Design',
                $customOrder->size->name,
                $customOrder->quantity,
                $customOrder->status_label,
                $customOrder->price_quote ? 'Rp ' . number_format($customOrder->price_quote, 0, ',', '.') : '-',
                $customOrder->created_at->format('d M Y H:i'),
                $customOrder->estimated_completion_date ? $customOrder->estimated_completion_date->format('d M Y') : '-',
            ]);
        }

        fclose($handle);

        return response()->stream(
            function () use ($handle) {
                // Already outputted
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }

    /**
     * Get custom order statistics.
     */
    public function stats()
    {
        $stats = [
            'total' => CustomOrder::count(),
            'pending' => CustomOrder::where('status', 'pending')->count(),
            'review' => CustomOrder::where('status', 'review')->count(),
            'design' => CustomOrder::where('status', 'design')->count(),
            'production' => CustomOrder::where('status', 'production')->count(),
            'completed' => CustomOrder::where('status', 'completed')->count(),
            'cancelled' => CustomOrder::where('status', 'cancelled')->count(),
            'this_month' => CustomOrder::whereMonth('created_at', now()->month)->count(),
            'this_year' => CustomOrder::whereYear('created_at', now()->year)->count(),
        ];

        return response()->json($stats);
    }
}