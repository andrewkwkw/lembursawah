<?php

namespace App\Livewire\Frontend;

use App\Models\Attraction;
use Livewire\Component;

class DestinationDetail extends Component
{
    public $destination;

    public function mount($slug)
    {
        $this->destination = Attraction::where('id', $slug)->orWhere('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.destination-detail')
            ->layout('components.layouts.app', ['title' => $this->destination->name . ' - Lembur Sawah']);
    }
}
