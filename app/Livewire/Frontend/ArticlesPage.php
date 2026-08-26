<?php

namespace App\Livewire\Frontend;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesPage extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Article::query()->where('is_published', true);

        if (!empty($this->search)) {
            $search = str_replace(['%', '_'], ['\%', '\_'], $this->search);
            $query->where('title', 'like', '%' . $search . '%');
        }

        if (!empty($this->selectedCategory)) {
            $query->where('category', $this->selectedCategory);
        }

        // We will separate the featured article from the paginated list
        $featuredArticle = Article::where('is_published', true)
                                ->where('is_featured', true)
                                ->latest()
                                ->first();

        // Exclude the featured article from the list to avoid duplication
        if ($featuredArticle) {
            $query->where('id', '!=', $featuredArticle->id);
        }

        $articles = $query->latest('published_at')->paginate(6);

        // Get unique categories for the filter pills (cached for 10 minutes)
        $categories = cache()->remember('article_categories', 600, function () {
            return Article::where('is_published', true)
                ->whereNotNull('category')
                ->select('category')
                ->distinct()
                ->pluck('category')
                ->toArray();
        });

        return view('livewire.frontend.articles-page', [
            'articles' => $articles,
            'featuredArticle' => $featuredArticle,
            'categories' => $categories,
        ])->layout('components.layouts.app', ['title' => 'Articles - Lembur Sawah']);
    }
}
