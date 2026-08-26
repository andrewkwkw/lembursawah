<div class="min-h-screen bg-surface">
    <div class="pt-32 pb-16 px-4 md:px-8 max-w-[1280px] mx-auto">
        
        <!-- Header -->
        <div class="mb-16 text-center max-w-[768px] mx-auto">
            <h1 class="font-display-lg md:font-display-xl text-primary font-bold mb-4">
                Tanya Jawab Umum
            </h1>
            <p class="font-body-lg text-on-surface-variant">
                Temukan jawaban atas pertanyaan umum seputar kunjungan ke Lembur Sawah. Jika Anda tidak menemukan apa yang Anda cari, jangan ragu untuk bertanya!
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 max-w-6xl mx-auto">
            
            <!-- FAQs Accordion List -->
            <div class="w-full lg:w-2/3">
                @if($faqs->count() > 0)
                    <div class="flex flex-col gap-4">
                        @foreach($faqs as $faq)
                            <div x-data="{ expanded: false }" class="bg-white border border-outline-variant/30 rounded-2xl overflow-hidden transition-all duration-300 shadow-sm hover:shadow-md">
                                <button @click="expanded = !expanded" class="w-full text-left px-6 py-5 flex items-center justify-between focus:outline-none hover:bg-surface-variant/30 transition-colors">
                                    <h3 class="font-label-lg font-bold text-on-surface pr-8">{{ $faq->question }}</h3>
                                    <span class="material-symbols-outlined text-primary transition-transform duration-300" :class="{ 'rotate-180': expanded }">expand_more</span>
                                </button>
                                <div x-show="expanded" x-collapse x-cloak>
                                    <div class="px-6 pb-6 pt-2 font-body-md text-on-surface-variant border-t border-outline-variant/10">
                                        {{ $faq->answer }}
                                    </div>
                                    @if($faq->asked_by_name)
                                        <div class="px-6 pb-4 pt-0">
                                            <span class="inline-block bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full text-xs font-medium">Asked by {{ $faq->asked_by_name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-white border border-outline-variant/30 rounded-2xl">
                        <span class="material-symbols-outlined text-5xl text-on-surface-variant/50 mb-4">quiz</span>
                        <h3 class="font-headline-sm font-bold text-on-surface mb-2">No Questions Yet</h3>
                        <p class="font-body-md text-on-surface-variant">Be the first to ask a question about Lembur Sawah!</p>
                    </div>
                @endif
            </div>

            <!-- Ask a Question Form -->
            <div class="w-full lg:w-1/3">
                <div class="bg-primary/5 rounded-3xl p-8 border border-primary/20 sticky top-24">
                    <h3 class="font-headline-sm font-bold text-on-surface mb-2">Have a Question?</h3>
                    <p class="font-body-sm text-on-surface-variant mb-6">Submit your question below and our team will answer it shortly.</p>
                    
                    @if (session()->has('success'))
                        <div class="bg-secondary-container text-on-secondary-container p-4 rounded-xl mb-6 flex gap-3 items-start">
                            <span class="material-symbols-outlined shrink-0">check_circle</span>
                            <span class="font-body-sm">{{ session('success') }}</span>
                        </div>
                    @endif

                    @error('rate_limit')
                        <div class="bg-error-container text-on-error-container p-4 rounded-xl mb-6 flex gap-3 items-start">
                            <span class="material-symbols-outlined shrink-0">warning</span>
                            <span class="font-body-sm">{{ $message }}</span>
                        </div>
                    @enderror

                    <form wire:submit="submitQuestion" class="flex flex-col gap-5">
                        <div>
                            <label for="asked_by_name" class="block font-label-md font-bold text-on-surface mb-2">Your Name</label>
                            <input type="text" id="asked_by_name" wire:model="asked_by_name" class="w-full px-4 py-3 rounded-xl border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-body-md text-on-surface bg-white" placeholder="John Doe">
                            @error('asked_by_name') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="question" class="block font-label-md font-bold text-on-surface mb-2">Question</label>
                            <textarea id="question" wire:model="question" rows="4" class="w-full px-4 py-3 rounded-xl border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-body-md text-on-surface bg-white resize-none" placeholder="What time does the village open?"></textarea>
                            @error('question') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full py-3 px-6 bg-primary text-on-primary font-label-lg font-bold rounded-full hover:bg-primary/90 transition-colors flex items-center justify-center gap-2 group">
                            <span wire:loading.remove wire:target="submitQuestion">Submit Question</span>
                            <span wire:loading wire:target="submitQuestion">Submitting...</span>
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform" wire:loading.remove wire:target="submitQuestion">send</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
