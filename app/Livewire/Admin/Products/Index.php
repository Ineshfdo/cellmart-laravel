<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Index extends Component
{
    public $expanded = [];

    public function toggleDescription($id)
    {
        if (isset($this->expanded[$id])) {
            unset($this->expanded[$id]);
        } else {
            $this->expanded[$id] = true;
        }
    }

    public function deleteProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();
        session()->flash('success', 'Product deleted successfully!');
    }

    public function render()
    {
        $products = DB::table('products')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.products.index', [
            'products' => $products
        ]);
    }
}
