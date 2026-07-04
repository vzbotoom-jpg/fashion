<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PreOrder;
use App\Models\Size;
use App\Services\PreOrderService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PreOrderController extends Controller
{
    protected $preOrderService;
    protected $notificationService;

    public function __construct(
        PreOrderService $preOrderService,
        NotificationService $notificationService
    ) {
        $this->preOrderService = $preOrderService;
        $this->notificationService = $notificationService;
    }

    public function create($productSlug)
    {
        $product = Product::where('slug', $productSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $sizes = Size::where('is_active', true)->get();

        return view('customer.pre-order.create', compact('product', 'sizes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $preOrder = $this->preOrderService->createPreOrder(
            Auth::id(),
            $request->all()
        );

        $this->notificationService->sendPreOrderNotification($preOrder);

        return redirect()->route('customer.pre-order.success')
            ->with('pre_order', $preOrder);
    }

    public function success()
    {
        $preOrder = session('pre_order');
        if (!$preOrder) {
            return redirect()->route('home');
        }

        return view('customer.pre-order.success', compact('preOrder'));
    }
}