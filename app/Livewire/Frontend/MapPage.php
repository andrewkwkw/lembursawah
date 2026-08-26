<?php

namespace App\Livewire\Frontend;

use App\Models\MapPoint;
use Livewire\Component;

class MapPage extends Component
{
    public function render()
    {
        $mapPoints = MapPoint::all();

        return view('livewire.frontend.map-page', [
            'mapPoints' => $mapPoints,
        ])->layout('components.layouts.app', ['title' => 'Peta Lokasi - Lembur Sawah']);
    }
}
