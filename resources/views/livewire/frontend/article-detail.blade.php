<div class="pt-24 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[800px] mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm font-medium text-on-surface-variant">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/articles') }}" class="hover:text-primary transition-colors">Berita & Artikel</a>
            <span class="mx-2">/</span>
            <span class="text-on-surface line-clamp-1">{{ $article->title }}</span>
        </nav>

        <div class="mb-8">
            <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-on-surface mb-6 leading-tight">{{ $article->title }}</h1>
            <div class="flex items-center gap-4 text-on-surface-variant text-sm font-medium">
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    {{ $article->created_at->translatedFormat('d F Y') }}
                </div>
                <div class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    {{ $article->author_name ?? 'Admin' }}
                </div>
            </div>
        </div>

        @if($article->image)
            <div class="relative w-full h-[300px] md:h-[450px] rounded-2xl overflow-hidden mb-12 shadow-md">
                <img loading="lazy" src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <style>
            .prose-article p {
                margin-bottom: 1.5rem !important;
                line-height: 1.85 !important;
            }
            .prose-article p:last-child {
                margin-bottom: 0 !important;
            }
            .prose-article figure, .prose-article img {
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
                border-radius: 0.75rem !important;
            }
            .prose-article figure {
                text-align: center !important;
            }
            .prose-article em {
                display: inline-block;
                color: #525a4e;
                font-size: 0.925rem;
                margin-top: -0.5rem;
                margin-bottom: 1.25rem;
            }
            .prose-article h2, .prose-article h3, .prose-article h4 {
                margin-top: 2rem !important;
                margin-bottom: 1rem !important;
                font-weight: 700 !important;
            }
            .prose-article ul, .prose-article ol {
                margin-bottom: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .prose-article li {
                margin-bottom: 0.5rem !important;
                line-height: 1.75 !important;
            }
            .prose-article blockquote {
                border-left: 4px solid var(--color-primary, #0d631b) !important;
                padding-left: 1rem !important;
                margin: 1.5rem 0 !important;
                font-style: italic !important;
                color: #525a4e !important;
            }
        </style>
        <div class="prose prose-lg text-on-surface-variant max-w-none prose-headings:text-on-surface prose-a:text-primary prose-img:rounded-xl prose-article">
            {!! \Stevebauman\Purify\Facades\Purify::clean($article->content) !!}
        </div>
        
        <div class="mt-16 pt-8 border-t border-outline-variant/30 flex justify-between items-center">
            <a href="{{ url('/articles') }}" class="flex items-center gap-2 text-primary hover:underline font-medium">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Daftar Artikel
            </a>
            
            <!-- Share buttons could go here -->
        </div>
    </div>
</div>
