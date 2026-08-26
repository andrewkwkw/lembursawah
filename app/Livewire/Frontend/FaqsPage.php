<?php

namespace App\Livewire\Frontend;

use App\Models\Faq;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Rule;

class FaqsPage extends Component
{
    #[Rule('required|string|max:100')]
    public string $asked_by_name = '';

    #[Rule('required|string|max:500')]
    public string $question = '';

    public function submitQuestion()
    {
        $this->validate();

        $ip = request()->ip();
        $key = 'submit-faq-' . $ip;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('rate_limit', 'You have submitted too many questions. Please try again in ' . ceil($seconds / 60) . ' minutes.');
            return;
        }

        RateLimiter::hit($key, 3600); // 3 attempts per hour

        Faq::create([
            'asked_by_name' => $this->asked_by_name,
            'question' => $this->question,
            'status' => 'pending',
        ]);

        $this->reset(['asked_by_name', 'question']);
        
        session()->flash('success', 'Your question has been submitted successfully and is awaiting review.');
    }

    public function render()
    {
        $faqs = Faq::where('status', 'approved')->orderBy('id', 'desc')->get();

        return view('livewire.frontend.faqs-page', [
            'faqs' => $faqs,
        ])->layout('components.layouts.app', ['title' => 'FAQ - Lembur Sawah']);
    }
}
