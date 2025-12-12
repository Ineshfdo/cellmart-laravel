<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Auth facade

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = Products::find($item['product_id'] ?? 0);
            if ($product) {
                $subtotal = $product->price * ($item['quantity'] ?? 1);
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'] ?? 1,
                    'color' => $item['color'] ?? null,
                    'warranty' => $item['warranty'] ?? null,
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        $user = Auth::user(); // <-- Safe now
        return view('Pages.checkout.index', compact('cartItems', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'customer_name' => 'nullable|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }

        $orderProducts = [];
        $total = 0;

        foreach ($cart as $item) {
            $product = Products::find($item['product_id'] ?? 0);
            if ($product) {
                $subtotal = $product->price * ($item['quantity'] ?? 1);
                $orderProducts[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'] ?? 1,
                    'color' => $item['color'] ?? null,
                    'warranty' => $item['warranty'] ?? null,
                    'subtotal' => $subtotal,
                    'image' => $product->image,
                    'currency' => $product->currency
                ];
                $total += $subtotal;
            }
        }

        $user = Auth::user(); // <-- Safe now

        $order = Order::create([
            'user_id' => $user?->id,
            'customer_name' => $request->customer_name ?? $user?->name,
            'customer_email' => $request->customer_email ?? $user?->email,
            'customer_phone' => $request->customer_phone ?? $user?->phone ?? null,
            'delivery_address' => $request->delivery_address,
            'products' => $orderProducts,
            'total_amount' => $total,
            'currency' => $orderProducts[0]['currency'] ?? 'LKR',
            'status' => 'pending'
        ]);

        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id);
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('Pages.checkout.success', compact('order'));
    }
}
