<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TourPackage;

class PackagesPage extends Component
{
    use WithPagination;

    public $selectedDuration = '';
    public $selectedPrice = '';

    protected $queryString = [
        'selectedDuration' => ['except' => ''],
        'selectedPrice' => ['except' => ''],
    ];

    public function updatingSelectedDuration()
    {
        $this->resetPage();
    }

    public function updatingSelectedPrice()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = TourPackage::query();

        if (!empty($this->selectedDuration)) {
            $duration = str_replace(['%', '_'], ['\%', '\_'], $this->selectedDuration);
            $query->where('duration', 'like', '%' . $duration . '%');
        }

        if (!empty($this->selectedPrice)) {
            $range = $this->selectedPrice;
            if ($range === '0-250000') {
                $query->whereBetween('price', [0, 250000]);
            } elseif ($range === '250000-500000') {
                $query->whereBetween('price', [250000, 500000]);
            } elseif ($range === '500000-1000000') {
                $query->whereBetween('price', [500000, 1000000]);
            } elseif ($range === '1000000+') {
                $query->where('price', '>=', 1000000);
            }
        }

        // We want the most popular ones to show first if they exist, then latest.
        $packages = $query->orderBy('is_popular', 'desc')->latest()->paginate(6);

        return view('livewire.frontend.packages-page', [
            'packages' => $packages,
        ])->layout('components.layouts.app', ['title' => 'Tour Packages - Lembur Sawah']);
    }
}
