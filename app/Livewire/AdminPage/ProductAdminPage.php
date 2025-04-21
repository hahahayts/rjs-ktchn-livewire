<?php

namespace App\Livewire\AdminPage;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductAdminPage extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Properties for managing form data
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $status = true;
    public $isActive = true;
    public $temporary_image;
    public $productId;

    // Properties for search and filters
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;

    // Validation rules
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required|min:10',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'temporary_image' => 'nullable|image|max:1024',
        'status' => 'boolean',
        'isActive' => 'boolean',
    ];

    // Reset pagination when search is updated
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Sort products
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    // Open modal for adding a new product
    public function openModal()
    {
        $this->resetValidation();
        $this->reset(['name', 'description', 'price', 'stock', 'temporary_image', 'status', 'isActive', 'productId']);
        $this->editMode = false;
        $this->showModal = true;
    }

    // Open modal for editing a product
    public function edit($id)
    {
        $this->resetValidation();
        $this->editMode = true;
        $this->productId = $id;
        $product = Product::findOrFail($id);
        
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->isActive = $product->is_active;
        $this->image = $product->image;
        
        $this->showModal = true;
    }

    // Close the modal
    public function closeModal()
    {
        $this->showModal = false;
        $this->showDeleteModal = false;
    }

    // Confirm deletion modal
    public function confirmDelete($id)
    {
        $this->productId = $id;
        $this->showDeleteModal = true;
    }

    // Delete a product
    public function deleteProduct()
    {
        $product = Product::findOrFail($this->productId);
        
        // Delete the image if it exists
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }
        
        $product->delete();
        $this->showDeleteModal = false;
        
        session()->flash('message', 'Product successfully deleted.');
    }

    // Save a new product or update an existing one
    public function save()
    {
        $this->validate();
        
        try {
            if ($this->editMode) {
                $product = Product::findOrFail($this->productId);
            } else {
                $product = new Product();
            }
            
            $product->name = $this->name;
            $product->slug = Str::slug($this->name);
            $product->description = $this->description;
            $product->price = $this->price;
            $product->stock = $this->stock;
            $product->status = $this->status;
            $product->is_active = $this->isActive;
            
            // Handle image upload
            if ($this->temporary_image) {
                // Delete old image if exists
                if ($product->image) {
                    Storage::disk('public')->delete('products/' . $product->image);
                }
                
                $filename = time() . '_' . $this->temporary_image->getClientOriginalName();
                $this->temporary_image->storeAs('products', $filename, 'public');
                $product->image = $filename;
            }
            
            $product->save();
            $this->showModal = false;
            
            $message = $this->editMode ? 'Product updated successfully.' : 'Product created successfully.';
            session()->flash('message', $message);
            
            $this->reset(['name', 'description', 'price', 'stock', 'temporary_image', 'status', 'isActive', 'productId']);
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
        finally{
            return redirect('/admin/products');
        }
    }

    // Toggle product status
    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = !$product->status;
        $product->save();
        
        session()->flash('message', 'Product status updated.');
    }

    // Render the component
    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
            
        return view('livewire.admin-page.product-admin-page', [
            'products' => $products,
        ]);
    }
}
