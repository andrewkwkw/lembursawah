<?php

namespace App\Livewire\Frontend;

use App\Models\TourPackage;
use Livewire\Component;

class PackageDetail extends Component
{
    public $package;

    public function mount($slug)
    {
        $this->package = TourPackage::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.package-detail')
            ->layout('components.layouts.app', ['title' => $this->package->name . ' - Lembur Sawah']);
    }
}
