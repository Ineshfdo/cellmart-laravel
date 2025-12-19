<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $category;
    public $subcategory;
    public $price;
    public $currency;
    public $ram;
    public $storage;
    public $description;
    public $currentImage;
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
            'description' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,webp',
        ];
    }

    public function mount($product)
    {
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category = $product->category;
        $this->subcategory = $product->subcategory;
        $this->price = $product->price;
        $this->currency = $product->currency;
        $this->ram = $product->ram;
        $this->storage = $product->storage;
        $this->description = $product->description;
        $this->currentImage = $product->image;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImageFile()
    {
        $this->validateOnly('image_file');
    }

    public function update()
    {
        $this->validate();

        $updateData = [
            'name' => $this->name,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'price' => $this->price,
            'currency' => $this->currency,
            'ram' => $this->ram,
            'storage' => $this->storage,
            'description' => $this->description,
        ];

        if ($this->image_file) {
            $uploadPath = public_path('images/products');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $this->image_file->getClientOriginalExtension();
            
            // Move the file from Livewire temp directory to public
            File::move($this->image_file->getRealPath(), $uploadPath . '/' . $filename);
            
            $updateData['image'] = 'images/products/' . $filename;

            // Delete old image if it exists and is local
            if ($this->currentImage && !filter_var($this->currentImage, FILTER_VALIDATE_URL)) {
                $oldImagePath = public_path($this->currentImage);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
        }

        DB::table('products')
            ->where('id', $this->productId)
            ->update($updateData);

        session()->flash('success', 'Product updated successfully!');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}
