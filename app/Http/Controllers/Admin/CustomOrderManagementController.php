<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomOrderManagementController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

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

    public function show($id)
    {
        $customOrder = CustomOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.custom-orders.show', compact('customOrder'));
    }

    public function process(Request $request, $id)
    {
        $customOrder = CustomOrder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,review,design,production,shipped,completed,cancelled',
            'notes' => 'nullable|string|max:500',
            'price_quote' => 'nullable|numeric|min:0',
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

        $customOrder->update($data);

        $this->notificationService->sendCustomOrderStatusUpdate($customOrder);

        return redirect()->route('admin.custom-orders.show', $customOrder->id)
            ->with('success', 'Status custom order berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        
        if ($customOrder->custom_image) {
            \Storage::delete('public/' . $customOrder->custom_image);
        }

        $customOrder->delete();

        return redirect()->route('admin.custom-orders.index')
            ->with('success', 'Custom order berhasil dihapus!');
    }
}