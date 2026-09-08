<div class="pt-8 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[1280px] mx-auto">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

            <!-- Sidebar / Filters -->
            <aside class="w-full lg:w-1/4 shrink-0">
                <div
                    class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-6 sticky top-24 shadow-sm">
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-6">Filter</h2>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h3
                            class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">
                            Kategori</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="Air Terjun / Alam"
                                    class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Air Terjun / Alam</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="Persawahan"
                                    class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Persawahan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="Warisan Budaya"
                                    class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Warisan Budaya</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" wire:model.live="selectedCategories" value="Restoran"
                                    class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Restoran</span>
                            </label>
                        </div>
                    </div>

                    <!-- Difficulty -->
                    <div>
                        <h3
                            class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">
                            Tingkat Kesulitan</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDifficulty" value="Any"
                                    class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Semua</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDifficulty" value="Akses Kendaraan"
                                    class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Akses Kendaraan</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDifficulty" value="Jalan Santai"
                                    class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Jalan Santai</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDifficulty" value="Mendaki"
                                    class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                                <span
                                    class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Mendaki</span>
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="w-full lg:w-3/4 flex flex-col">

                <!-- Header & Search -->
                <div class="mb-8">
                    <h1 class="font-display-md text-display-md font-bold text-on-surface mb-4">Jelajahi Destinasi</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-[672px] mb-6">Temukan keindahan alam dan kekayaan warisan budaya Lembur Sawah. Dari gemercik air terjun hingga hamparan sawah yang asri.</p>

                    <div class="relative w-full max-w-[576px]">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input type="text" wire:model.live="search" placeholder="Cari destinasi wisata..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary bg-surface outline-none transition-all font-body-md text-body-md placeholder:text-on-surface-variant/70">
                    </div>
                </div>

                <!-- Loading State -->
                <div wire:loading.flex class="justify-center items-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
                </div>

                <!-- Grid -->
                <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[380px]">
                    @forelse($destinations as $index => $destination)
                        @php
                            // Determine logic for bento grid spanning
                            // 0: span 2, 1: span 1, 2: span 1, 3: span 2, 4: span 2, 5: span 1...
                            $isLarge = ($index % 4 === 0) || ($index % 4 === 3);
                            $detailUrl = $destination->link_url ?? route('destination.detail', $destination->slug ?? $destination->id);
                        @endphp

                        @if($isLarge)
                            <!-- Large Card -->
                            <a wire:navigate href="{{ $detailUrl }}"
                                class="relative rounded-2xl overflow-hidden group shadow-sm hover:shadow-md transition-shadow duration-300 md:col-span-2 block cursor-pointer">
                                @if($destination->image)
                                    <img loading="lazy" src="{{ Storage::url($destination->image) }}" alt="{{ $destination->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-surface-container-high"></div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                                <div class="absolute inset-0 flex flex-col justify-end p-6 text-white">
                                    <div class="flex items-center gap-2 mb-3">
                                        @if($destination->category)
                                            <span
                                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-primary text-on-primary">
                                                {{ $destination->category }}
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="font-headline-sm text-headline-sm font-bold mb-2 text-white">
                                        {{ $destination->name }}</h3>
                                    <p class="font-body-sm text-body-sm text-white/80 line-clamp-2 max-w-[80%]">
                                        {{ strip_tags($destination->description) }}</p>
                                </div>
                            </a>
                        @else
                            <!-- Small Card -->
                            <div
                                class="flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-outline-variant/30 overflow-hidden group md:col-span-1">
                                <a wire:navigate href="{{ $detailUrl }}" class="relative h-48 shrink-0 overflow-hidden block">
                                    @if($destination->image)
                                        <img loading="lazy" src="{{ Storage::url($destination->image) }}"
                                            alt="{{ $destination->name }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-surface-container-high"></div>
                                    @endif

                                    @if($destination->category)
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-primary text-on-primary shadow-sm">
                                                {{ $destination->category }}
                                            </span>
                                        </div>
                                    @endif
                                </a>

                                <div class="flex flex-col flex-1 p-5">
                                    <h3 class="font-title-lg text-title-lg font-bold mb-2 text-on-surface line-clamp-1">
                                        <a wire:navigate href="{{ $detailUrl }}"
                                            class="hover:text-primary transition-colors">{{ $destination->name }}</a>
                                    </h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-2 mb-4">
                                        {{ strip_tags($destination->description) }}</p>

                                    <div class="mt-auto pt-2">
                                        <a wire:navigate href="{{ $detailUrl }}"
                                            class="block w-full py-2.5 text-center rounded-lg border border-primary text-primary hover:bg-primary/5 transition-colors font-label-md font-semibold">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <div
                            class="md:col-span-3 py-12 flex flex-col items-center justify-center border-2 border-dashed border-outline-variant rounded-2xl">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">search_off</span>
                            <h3 class="font-headline-sm text-on-surface mb-2">Tidak ada destinasi ditemukan</h3>
                            <p class="text-on-surface-variant text-center max-w-[448px]">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                            <button
                                wire:click="$set('search', ''); $set('selectedCategories', []); $set('selectedDifficulty', 'Any')"
                                class="mt-4 px-6 py-2 bg-primary text-on-primary rounded-lg hover:opacity-90">Reset Filter</button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $destinations->links(data: ['scrollTo' => false]) }}
                </div>
            </div>

        </div>
    </div>
</div>