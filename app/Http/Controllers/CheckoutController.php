<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Import Auth facade
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

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
        $lineItems = [];

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

                // Prepare line items for Stripe
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $product->name,
                            'description' => ($item['color'] ? 'Color: ' . $item['color'] : '') . 
                                           ($item['warranty'] ? ' | Warranty: ' . $item['warranty'] : ''),
                        ],
                        'unit_amount' => (int)($product->price * 100), // Convert to cents
                    ],
                    'quantity' => $item['quantity'] ?? 1,
                ];
            }
        }

        $user = Auth::user();

        // Create order with pending status
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

        // Store order ID in session for later verification
        session(['pending_order_id' => $order->id]);

        // Initialize Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create Stripe Checkout Session
            $checkoutSession = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success', ['orderId' => $order->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.index') . '?canceled=1',
                'customer_email' => $request->customer_email ?? $user?->email,
                'metadata' => [
                    'order_id' => $order->id,
                ],
            ]);

            // Redirect to Stripe Checkout
            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            // If Stripe fails, delete the pending order and show error
            $order->delete();
            return redirect()->route('checkout.index')->with('error', 'Payment gateway error: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Verify Stripe payment if session_id is present
        if (request()->has('session_id')) {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            try {
                $session = \Stripe\Checkout\Session::retrieve(request()->get('session_id'));
                
                // Verify the payment was successful
                if ($session->payment_status === 'paid') {
                    // Update order status to completed
                    $order->update(['status' => 'completed']);
                    
                    // Clear the cart
                    session()->forget('cart');
                    session()->forget('pending_order_id');

                    // Send Order Confirmation Email
                    try {
                         Mail::to($order->customer_email)->send(new OrderPlaced($order));
                    } catch (\Exception $e) {
                         \Log::error('Order email sending failed: ' . $e->getMessage());
                    }
                }
            } catch (\Exception $e) {
                // Log error but still show success page
                \Log::error('Stripe verification error: ' . $e->getMessage());
            }
        }
        
        return view('Pages.checkout.success', compact('order'));
    }
}
