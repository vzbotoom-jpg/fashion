<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PreOrder;
use App\Models\CustomOrder;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('admin.dashboard')
                ->with('warning', 'Masukkan kata kunci pencarian.');
        }

        $results = [
            'products' => Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'orders' => Order::where('order_number', 'LIKE', "%{$query}%")
                ->orWhere('shipping_address', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'pre_orders' => PreOrder::where('order_number', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'custom_orders' => CustomOrder::where('order_number', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'users' => User::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),

            'messages' => ContactMessage::where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->orWhere('subject', 'LIKE', "%{$query}%")
                ->orWhere('message', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get(),
        ];

        return view('admin.search.index', compact('results', 'query'));
    }
}