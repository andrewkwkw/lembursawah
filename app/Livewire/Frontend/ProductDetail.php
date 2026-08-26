<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.product-detail')
            ->layout('components.layouts.app', ['title' => $this->product->name . ' - Lembur Sawah']);
    }
}
