<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $quantities = [];

    public function mount()
    {
        $this->refreshQuantities();
    }

    public function refreshQuantities()
    {
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) {
            $this->quantities[$key] = $item['quantity'];
        }
    }

    public function updateCart()
    {
        $cart = session()->get('cart', []);
        
        foreach ($this->quantities as $key => $quantity) {
            // Ensure quantity is an integer
            $quantity = intval($quantity);
            
            if ($quantity > 0 && isset($cart[$key])) {
                $cart[$key]['quantity'] = $quantity;
            } elseif ($quantity <= 0 && isset($cart[$key])) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);
        session()->flash('success', 'Cart updated successfully!');
        
        // Refresh local quantities to match sanitized session data
        $this->refreshQuantities();
    }

    public function removeItem($key)
    {
        // No need for logic check here if wire:confirm is used on frontend, 
        // but it doesn't hurt to be safe.
        $cart = session()->get('cart', []);
        
        if (isset($cart[$key])) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            session()->flash('success', 'Product removed from cart!');
            
            // Remove from local quantities array as well
            unset($this->quantities[$key]);
        }
    }

    public function render()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $key => $item) {
            // Check if item has necessary keys
            if (is_array($item) && isset($item['product_id'])) {
                $product = Products::find($item['product_id']);
                if ($product) {
                    $subtotal = $product->price * $item['quantity'];
                    $cartItems[] = [
                        'key' => $key,
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'color' => $item['color'],
                        'warranty' => $item['warranty'],
                        'subtotal' => $subtotal
                    ];
                    $total += $subtotal;
                }
            }
        }

        return view('livewire.shopping-cart', compact('cartItems', 'total'));
    }
}
