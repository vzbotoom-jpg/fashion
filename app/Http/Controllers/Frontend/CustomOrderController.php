<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CustomOrder;
use App\Models\Size;
use App\Services\CustomOrderService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomOrderController extends Controller
{
    protected $customOrderService;
    protected $notificationService;

    public function __construct(
        CustomOrderService $customOrderService,
        NotificationService $notificationService
    ) {
        $this->customOrderService = $customOrderService;
        $this->notificationService = $notificationService;
    }

    public function create(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::where('id', $request->product_id)
                ->where('is_active', true)
                ->first();
        }

        $sizes = Size::where('is_active', true)->get();

        return view('customer.custom-order.create', compact('product', 'sizes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'nullable|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1',
            'custom_description' => 'required|string|max:1000',
            'custom_image' => 'nullable|image|max:2048',
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customOrder = $this->customOrderService->createCustomOrder(
            Auth::id(),
            $request->all()
        );

        $this->notificationService->sendCustomOrderNotification($customOrder);

        return redirect()->route('customer.custom-order.success')
            ->with('custom_order', $customOrder);
    }

    public function success()
    {
        $customOrder = session('custom_order');
        if (!$customOrder) {
            return redirect()->route('home');
        }

        return view('customer.custom-order.success', compact('customOrder'));
    }
}