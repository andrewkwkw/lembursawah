<?php

namespace App\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class MarketPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $selectedPrice = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedPrice' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatingSelectedPrice()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();

        if (!empty($this->search)) {
            $search = str_replace(['%', '_'], ['\%', '\_'], $this->search);
            $query->where('name', 'like', '%' . $search . '%');
        }

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category', $this->selectedCategories);
        }

        if (!empty($this->selectedPrice)) {
            $query->where(function ($q) {
                if ($this->selectedPrice === '0-50000') {
                    $q->whereBetween('price', [0, 50000]);
                } elseif ($this->selectedPrice === '50000-100000') {
                    $q->whereBetween('price', [50000, 100000]);
                } elseif ($this->selectedPrice === '100000+') {
                    $q->where('price', '>=', 100000);
                }
            });
        }

        $featuredProduct = Product::where('is_featured', true)->first();

        if ($featuredProduct) {
            $query->where('id', '!=', $featuredProduct->id);
        }

        $products = $query->latest()->paginate(9);

        $categoryCounts = cache()->remember('product_category_counts', 600, function () {
            return Product::selectRaw('category, count(*) as count')
                ->whereNotNull('category')
                ->groupBy('category')
                ->pluck('count', 'category')
                ->toArray();
        });

        return view('livewire.frontend.market-page', [
            'products' => $products,
            'featuredProduct' => $featuredProduct,
            'categoryCounts' => $categoryCounts,
        ])->layout('components.layouts.app', ['title' => 'Pasar Produk UMKM - Lembur Sawah']);
    }
}
