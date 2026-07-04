<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart(Auth::id());
        $cartTotal = $this->cartService->calculateTotal(Auth::id());

        return view('customer.cart.index', compact('cart', 'cartTotal'));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check stock availability
        $productSize = ProductSize::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->first();

        if (!$productSize || $productSize->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi!'
            ], 400);
        }

        $cartItem = $this->cartService->addToCart(
            Auth::id(),
            $request->product_id,
            $request->size_id,
            $request->quantity
        );

        $cartCount = $this->cartService->getCartCount(Auth::id());

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cartCount,
            'cart_item' => $cartItem
        ]);
    }

    public function remove($id)
    {
        $this->cartService->removeFromCart(Auth::id(), $id);

        return redirect()->route('customer.cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $this->cartService->updateCartQuantity(Auth::id(), $id, $request->quantity);

        return redirect()->route('customer.cart.index')
            ->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function clear()
    {
        $this->cartService->clearCart(Auth::id());

        return redirect()->route('customer.cart.index')
            ->with('success', 'Keranjang berhasil dikosongkan!');
    }
}