<div>
    <section class="relative pt-32 pb-24 px-4 md:px-8 overflow-hidden rounded-b-[3rem]">
        @if($featuredArticle && $featuredArticle->image)
            <img loading="lazy" src="{{ asset('storage/' . $featuredArticle->image) }}" alt="{{ $featuredArticle->title }}"
                class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 w-full h-full bg-primary/20"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/50 to-black/80"></div>

        <div class="relative z-10 max-w-[1280px] mx-auto text-center flex flex-col items-center">
            @if($featuredArticle && $featuredArticle->category)
                <span
                    class="font-label-md text-primary-container font-bold uppercase tracking-[0.2em] mb-4">{{ $featuredArticle->category }}</span>
            @else
                <span class="font-label-md text-primary-container font-bold uppercase tracking-[0.2em] mb-4">Warta Lembur Sawah</span>
            @endif

            <h1 class="font-display-lg md:font-display-xl text-white font-bold mb-6">
                {{ $featuredArticle ? $featuredArticle->title : 'Kabar & Cerita Desa' }}
            </h1>

            <div class="font-body-lg text-white/90 max-w-[672px] mx-auto mb-10 line-clamp-2">
                @if($featuredArticle)
                    {!! strip_tags($featuredArticle->content) !!}
                @else
                    Temukan berita terbaru, warisan budaya, dan kisah menarik seputar desa kami.
                @endif
            </div>

            <div class="relative w-full max-w-[672px] mx-auto">
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Cari artikel, berita, atau cerita budaya desa..."
                    class="w-full px-8 py-4 md:py-5 bg-white/95 backdrop-blur-sm border-2 border-transparent focus:border-primary rounded-full shadow-lg font-body-lg text-on-surface placeholder:text-on-surface-variant/60 outline-none transition-all focus:ring-4 focus:ring-primary/20 text-center">
            </div>
        </div>
    </section>

    <main class="max-w-[1280px] mx-auto px-4 md:px-8 py-12">

        <div class="flex flex-wrap items-center justify-center gap-3 mb-12">
            <button wire:click="$set('selectedCategory', '')"
                class="px-5 py-2 rounded-full font-label-md font-semibold transition-colors {{ empty($selectedCategory) ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-variant/50 text-on-surface-variant hover:bg-surface-variant' }}">
                Semua
            </button>
            @foreach($categories as $cat)
                <button wire:click="$set('selectedCategory', '{{ $cat }}')"
                    class="px-5 py-2 rounded-full font-label-md font-semibold transition-colors {{ $selectedCategory === $cat ? 'bg-primary text-on-primary shadow-md' : 'bg-surface-variant/50 text-on-surface-variant hover:bg-surface-variant' }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <div wire:loading.class.remove="hidden" class="hidden fixed inset-0 bg-surface/50 z-50 backdrop-blur-[2px]">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
            </div>
        </div>

        <div>
            <h3 class="font-headline-sm text-headline-sm font-semibold text-on-surface mb-6">Artikel Terbaru</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($articles as $article)
                    <a wire:navigate href="{{ route('article.detail', $article->slug ?? $article->id) }}"
                        class="flex flex-col bg-white rounded-2xl border border-outline-variant/30 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group">
                        <!-- Image -->
                        <div class="relative w-full h-56 shrink-0 overflow-hidden">
                            @if($article->image)
                                <img loading="lazy" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant/40">image</span>
                                </div>
                            @endif

                            @if($article->category)
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-block px-3 py-1.5 bg-white/95 backdrop-blur-sm rounded-full text-xs font-bold text-primary shadow-sm uppercase tracking-wider">
                                        {{ $article->category }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex flex-col flex-1 p-6">
                            <h4
                                class="font-title-lg text-title-lg font-bold text-on-surface mb-3 line-clamp-2 group-hover:text-primary transition-colors leading-tight">
                                {{ $article->title }}</h4>
                            <p class="font-body-md text-body-md text-on-surface-variant line-clamp-3 mb-6">
                                {{ Str::limit(strip_tags($article->content), 150) }}</p>

                            <div
                                class="mt-auto flex items-center gap-2 text-primary font-label-md font-semibold group-hover:gap-3 transition-all">
                                Baca Selengkapnya <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div
                        class="col-span-full py-16 flex flex-col items-center justify-center text-center bg-surface-variant/20 rounded-3xl">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">article</span>
                        <h3 class="font-headline-sm text-on-surface mb-2">Belum Ada Artikel Ditemukan</h3>
                        <p class="text-on-surface-variant text-center max-w-[448px]">Kami tidak menemukan artikel yang sesuai dengan pencarian atau filter Anda.</p>
                        <button wire:click="$set('search', ''); $set('selectedCategory', '')"
                            class="mt-4 px-6 py-2 bg-primary text-on-primary rounded-lg hover:opacity-90">Reset Filter</button>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </main>
</div>