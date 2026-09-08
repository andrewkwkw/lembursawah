<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Attraction;

class DestinationsPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $selectedDifficulty = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedDifficulty' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

    public function updatingSelectedDifficulty()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Attraction::query();

        if ($this->search) {
            $search = str_replace(['%', '_'], ['\%', '\_'], $this->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category', $this->selectedCategories);
        }

        if ($this->selectedDifficulty && $this->selectedDifficulty !== 'Any') {
            $query->where('difficulty', $this->selectedDifficulty);
        }

        $destinations = $query->latest()->paginate(6);

        return view('livewire.frontend.destinations-page', [
            'destinations' => $destinations,
        ])->layout('components.layouts.app', ['title' => 'Destinasi Wisata - Lembur Sawah']);
    }
}
