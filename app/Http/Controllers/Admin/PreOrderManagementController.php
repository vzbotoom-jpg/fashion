<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreOrderManagementController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    /**
     * Display a listing of pre-orders.
     */
    public function index(Request $request)
    {
        $query = PreOrder::with(['user', 'product', 'size']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }

        $preOrders = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuses = ['pending', 'processing', 'production', 'shipped', 'completed', 'cancelled'];

        return view('admin.pre-orders.index', compact('preOrders', 'statuses'));
    }

    /**
     * Display the specified pre-order.
     */
    public function show($id)
    {
        $preOrder = PreOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.pre-orders.show', compact('preOrder'));
    }

    /**
     * Show the form for processing a pre-order.
     */
    public function process($id)
    {
        $preOrder = PreOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.pre-orders.process', compact('preOrder'));
    }

    /**
     * Update the specified pre-order status.
     */
    public function update(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,processing,production,shipped,completed,cancelled',
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

        if ($request->has('estimated_completion_date') && $request->estimated_completion_date) {
            $data['estimated_completion_date'] = $request->estimated_completion_date;
        }

        $preOrder->update($data);

        // Send notification
        $this->notificationService->sendPreOrderStatusUpdate($preOrder);

        return redirect()->route('admin.pre-orders.show', $preOrder->id)
            ->with('success', 'Status pre-order berhasil diperbarui!');
    }

    /**
     * Delete a pre-order.
     */
    public function destroy($id)
    {
        $preOrder = PreOrder::findOrFail($id);
        $preOrder->delete();

        return redirect()->route('admin.pre-orders.index')
            ->with('success', 'Pre-order berhasil dihapus!');
    }

    /**
     * Export pre-orders to CSV.
     */
    public function export(Request $request)
    {
        $query = PreOrder::with(['user', 'product', 'size']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $preOrders = $query->orderBy('created_at', 'desc')->get();

        $filename = 'pre-orders-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        // Header
        fputcsv($handle, [
            'Order Number',
            'Customer',
            'Product',
            'Size',
            'Quantity',
            'Status',
            'Created At',
            'Estimated Completion'
        ]);

        // Data
        foreach ($preOrders as $preOrder) {
            fputcsv($handle, [
                $preOrder->order_number,
                $preOrder->user->name,
                $preOrder->product->name,
                $preOrder->size->name,
                $preOrder->quantity,
                $preOrder->status_label,
                $preOrder->created_at->format('d M Y H:i'),
                $preOrder->estimated_completion_date ? $preOrder->estimated_completion_date->format('d M Y') : '-',
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
}