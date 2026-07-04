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

        return view('customer.my-orders.index', compact('orders', 'preOrders', 'customOrders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['items.product', 'items.size', 'payment', 'statuses'])
            ->findOrFail($id);

        return view('customer.my-orders.show', compact('order'));
    }

    public function track($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['statuses', 'payment'])
            ->findOrFail($id);

        $trackingStatus = $this->getTrackingStatus($order);

        return view('customer.my-orders.track', compact('order', 'trackingStatus'));
    }

    private function getTrackingStatus($order)
    {
        $statuses = $order->statuses->sortBy('created_at');
        
        $tracking = [];
        foreach ($statuses as $status) {
            $tracking[] = [
                'status' => $status->status,
                'description' => $status->description,
                'date' => $status->created_at->format('d M Y H:i'),
                'is_completed' => $status->is_current,
            ];
        }

        return $tracking;
    }
}