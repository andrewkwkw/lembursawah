<?php

namespace App\Livewire\Frontend;

use App\Models\Article;
use Livewire\Component;

class ArticleDetail extends Component
{
    public $article;

    public function mount($slug)
    {
        $this->article = Article::where('id', $slug)->orWhere('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.frontend.article-detail')
            ->layout('components.layouts.app', ['title' => $this->article->title . ' - Lembur Sawah']);
    }
}
