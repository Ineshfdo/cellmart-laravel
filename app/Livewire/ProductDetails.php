<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $quantity = 1;
    public $color = 'Black';
    public $warranty = '1 Year Company Warranty';

    public function mount($product)
    {
        $this->product = $product;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < 99) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function addToCart()
    {
        // Validation logic
        if ($this->quantity < 1) {
            $this->dispatch('alert', 'Please select a valid quantity (minimum 1)');
            return;
        }

        if (!$this->color) {
            $this->dispatch('alert', 'Please select a color');
            return;
        }

        if (!$this->warranty) {
            $this->dispatch('alert', 'Please select a warranty plan');
            return;
        }

        // Add to cart logic (replicating CartController behavior)
        $cart = session()->get('cart', []);

        // Create a unique key for this product variant (product_id + color + warranty)
        $cartKey = $this->product->id . '_' . $this->color . '_' . $this->warranty;

        if (isset($cart[$cartKey])) {
            // If same product with same color and warranty exists, add to quantity
            $cart[$cartKey]['quantity'] += $this->quantity;
        } else {
            // Add new cart item with all details
            $cart[$cartKey] = [
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'color' => $this->color,
                'warranty' => $this->warranty,
                'name' => $this->product->name,
                'price' => $this->product->price,
                'image' => $this->product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}
