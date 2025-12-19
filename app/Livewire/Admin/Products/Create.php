<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $category;
    public $subcategory;
    public $price;
    public $currency = 'LKR';
    public $ram;
    public $storage;
    public $description;
    public $image_file;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'ram' => 'nullable|string|max:50',
            'storage' => 'nullable|string|max:50',
            'image_file' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,webp',
            'description' => 'nullable|string',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImageFile()
    {
        $this->validateOnly('image_file');
    }

    public function store()
    {
        $validated = $this->validate();

        $imagePath = null;

        if ($this->image_file) {
            $uploadPath = public_path('images/products');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $this->image_file->getClientOriginalExtension();
            
            // Move file to public/images/products
            // Note: Livewire stores temp files differently, so we use store logic or standard getRealPath move
            // We'll use the same logic as in Edit.php which worked.
            File::move($this->image_file->getRealPath(), $uploadPath . '/' . $filename);
            
            $imagePath = 'images/products/' . $filename;
        }

        DB::table('products')->insert([
            'name' => $this->name,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'price' => $this->price,
            'currency' => $this->currency,
            'ram' => $this->ram,
            'storage' => $this->storage,
            'image' => $imagePath,
            'description' => $this->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'Product created successfully!');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }
}
