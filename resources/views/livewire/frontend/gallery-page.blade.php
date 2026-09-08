<div class="min-h-screen bg-surface">
    <div class="pt-24 pb-8 bg-surface"></div>

    <div class="max-w-[1280px] mx-auto px-4 md:px-8 pb-16">
        <!-- Header -->
        <div class="mb-12 max-w-[768px]">
            <h1 class="font-display-lg md:font-display-xl text-primary font-bold mb-4">
                Galeri Wisata
            </h1>
            <p class="font-body-lg text-on-surface-variant">
                Jelajahi keindahan alam, warisan budaya, dan kehidupan masyarakat Lembur Sawah melalui dokumentasi foto dan video.
            </p>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap items-center gap-3 mb-10">
            <button wire:click="setFilter('all')" class="px-6 py-2 rounded-full border {{ $filter === 'all' ? 'border-primary bg-primary text-on-primary font-bold' : 'border-outline-variant text-on-surface hover:bg-surface-variant' }} transition-colors font-label-md">
                Semua
            </button>
            <button wire:click="setFilter('photos')" class="px-6 py-2 rounded-full border {{ $filter === 'photos' ? 'border-primary bg-primary text-on-primary font-bold' : 'border-outline-variant text-on-surface hover:bg-surface-variant' }} transition-colors font-label-md">
                Foto
            </button>
            <button wire:click="setFilter('videos')" class="px-6 py-2 rounded-full border {{ $filter === 'videos' ? 'border-primary bg-primary text-on-primary font-bold' : 'border-outline-variant text-on-surface hover:bg-surface-variant' }} transition-colors font-label-md">
                Video
            </button>
        </div>

        <!-- Main Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 mb-16">
            @forelse($items as $item)
                <div class="group relative aspect-[4/3] overflow-hidden rounded-2xl bg-surface-variant shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow cursor-pointer">
                    @if($item->type === 'photo')
                        <a href="{{ asset('storage/' . $item->media_url) }}" class="glightbox block w-full h-full" data-title="{{ $item->title }}" data-description="{{ $item->description }}">
                            <img loading="lazy" src="{{ asset('storage/' . $item->media_url) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                <h3 class="font-headline-sm text-white font-bold">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="font-body-sm text-white/80 line-clamp-2 mt-1">{{ $item->description }}</p>
                                @endif
                            </div>
                        </a>
                    @else
                        <!-- Video Thumbnail/Player -->
                        @php
                            $youtubeId = '';
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $item->media_url, $match)) {
                                $youtubeId = $match[1];
                            }
                        @endphp
                        
                        <a href="{{ $item->media_url }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full" title="Tonton di YouTube">
                            @if($youtubeId)
                                <img loading="lazy" src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-surface-variant flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-on-surface-variant/50">videocam</span>
                                </div>
                            @endif

                            <!-- Video Play Icon Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="w-14 h-14 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-white border border-white/20 group-hover:bg-primary group-hover:scale-110 transition-all">
                                    <span class="material-symbols-outlined text-3xl">play_arrow</span>
                                </div>
                            </div>

                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 pointer-events-none">
                                <h3 class="font-headline-sm text-white font-bold">{{ $item->title }}</h3>
                            </div>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-16 flex flex-col items-center justify-center text-center bg-surface border border-dashed border-outline-variant/50 rounded-3xl">
                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/50 mb-4">imagesmode</span>
                    <h3 class="font-headline-sm font-bold text-on-surface mb-2">Belum Ada Dokumentasi Galeri</h3>
                    <p class="font-body-md text-on-surface-variant">
                        Silakan kembali lagi nanti untuk melihat dokumentasi foto dan video Lembur Sawah.
                    </p>
                </div>
            @endforelse
        </div>

        @if($items->hasPages())
            <div class="mb-16">
                {{ $items->links() }}
            </div>
        @endif

        <!-- Featured Videos Section -->
        @if($featuredVideos->count() > 0 && $filter !== 'photos')
            <div class="border-t border-outline-variant/30 pt-16 mb-8">
                <h2 class="font-display-sm text-primary font-bold mb-8">Video Pilihan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($featuredVideos as $video)
                        @php
                            $youtubeId = '';
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $video->media_url, $match)) {
                                $youtubeId = $match[1];
                            }
                        @endphp
                        
                        <a href="{{ $video->media_url }}" target="_blank" rel="noopener noreferrer" class="group flex flex-col bg-surface border border-outline-variant/30 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <div class="relative w-full aspect-video bg-black overflow-hidden">
                                @if($youtubeId)
                                    <img loading="lazy" src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg" alt="{{ $video->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="w-16 h-16 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center text-white border border-white/20 group-hover:bg-primary group-hover:scale-110 transition-all">
                                            <span class="material-symbols-outlined text-4xl">play_arrow</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-white/50">
                                        <span class="material-symbols-outlined text-4xl mb-2">broken_image</span>
                                        <span>Invalid Video URL</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="font-headline-sm font-bold text-on-surface mb-2 group-hover:text-primary transition-colors">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="font-body-md text-on-surface-variant">{{ $video->description }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    <!-- GLightbox CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            let lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
            });
            
            Livewire.hook('morph.updated', ({ el, component }) => {
                lightbox.reload();
            });
        });
    </script>
</div>
