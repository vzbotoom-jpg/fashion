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

    public function show($id)
    {
        $preOrder = PreOrder::with(['user', 'product', 'size'])->findOrFail($id);
        return view('admin.pre-orders.show', compact('preOrder'));
    }

    public function process(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:pending,processing,production,shipped,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $preOrder->update([
            'status' => $request->status,
            'admin_notes' => $request->notes,
        ]);

        $this->notificationService->sendPreOrderStatusUpdate($preOrder);

        return redirect()->route('admin.pre-orders.show', $preOrder->id)
            ->with('success', 'Status pre-order berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $preOrder = PreOrder::findOrFail($id);
        $preOrder->delete();

        return redirect()->route('admin.pre-orders.index')
            ->with('success', 'Pre-order berhasil dihapus!');
    }
}