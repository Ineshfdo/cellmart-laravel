<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            // Upload to Cloudinary for persistent storage on Railway
            $uploaded = Cloudinary::upload($this->image_file->getRealPath(), [
                'folder' => 'cellmart/products',
            ]);
            $imagePath = $uploaded->getSecurePath();
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
