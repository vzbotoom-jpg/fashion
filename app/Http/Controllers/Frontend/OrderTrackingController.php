<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PreOrder;
use App\Models\CustomOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:customer']);
    }

    /**
     * Display a listing of customer orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $preOrders = PreOrder::where('user_id', Auth::id())
            ->with(['product', 'size'])
            ->orderBy('created_at', 'desc')
            ->get();

        $customOrders = CustomOrder::where('user_id', Auth::id())
            ->with(['product', 'size'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.orders.index', compact('orders', 'preOrders', 'customOrders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.product', 'items.size', 'payment', 'statuses'])
            ->findOrFail($id);

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Track the specified order.
     */
    public function track($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['statuses', 'payment', 'items.product', 'items.size'])
            ->findOrFail($id);

        $trackingStatus = $this->getTrackingStatus($order);

        return view('customer.orders.track', compact('order', 'trackingStatus'));
    }

    /**
     * Cancel the specified order.
     */
    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $order->update(['status' => 'cancelled']);

        // Add status history
        $order->statuses()->create([
            'status' => 'cancelled',
            'description' => 'Pesanan dibatalkan oleh pelanggan',
            'is_current' => true,
        ]);

        return redirect()->back()
            ->with('success', 'Pesanan berhasil dibatalkan!');
    }

    /**
     * Get tracking status for an order.
     */
    private function getTrackingStatus($order)
    {
        $statuses = $order->statuses->sortBy('created_at');
        
        if ($statuses->isEmpty()) {
            // Jika tidak ada status, buat default
            return [
                [
                    'status' => 'pending',
                    'description' => 'Pesanan berhasil dibuat',
                    'date' => $order->created_at->format('d M Y H:i'),
                    'is_completed' => true,
                ]
            ];
        }

        $tracking = [];
        foreach ($statuses as $status) {
            $tracking[] = [
                'status' => $status->status,
                'description' => $status->description ?? $this->getDefaultDescription($status->status),
                'date' => $status->created_at->format('d M Y H:i'),
                'is_completed' => $status->is_current ?? false,
            ];
        }

        return $tracking;
    }

    /**
     * Get default description for status.
     */
    private function getDefaultDescription($status)
    {
        $descriptions = [
            'pending' => 'Pesanan sedang menunggu konfirmasi',
            'processing' => 'Pesanan sedang diproses oleh tim kami',
            'shipped' => 'Pesanan sedang dalam perjalanan',
            'delivered' => 'Pesanan telah sampai di tujuan',
            'completed' => 'Pesanan telah selesai',
            'cancelled' => 'Pesanan telah dibatalkan',
        ];

        return $descriptions[$status] ?? 'Status pesanan diperbarui';
    }
}