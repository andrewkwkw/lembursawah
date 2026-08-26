<?php

namespace App\Livewire\Frontend;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryPage extends Component
{
    use WithPagination;

    public $filter = 'all'; // all, photos, videos

    public function setFilter($type)
    {
        if (!in_array($type, ['all', 'photos', 'videos'])) {
            $type = 'all';
        }
        $this->filter = $type;
        $this->resetPage();
    }

    public function render()
    {
        $galleriesQuery = Gallery::query();

        if ($this->filter === 'photos') {
            $galleriesQuery->where('type', 'photo');
        } elseif ($this->filter === 'videos') {
            $galleriesQuery->where('type', 'video');
        }

        $items = $galleriesQuery->latest()->paginate(12);
        
        $featuredVideos = Gallery::where('type', 'video')->latest()->take(4)->get();

        return view('livewire.frontend.gallery-page', [
            'items' => $items,
            'featuredVideos' => $featuredVideos,
        ])->layout('components.layouts.app', ['title' => 'Galeri - Lembur Sawah']);
    }
}
