<div class="pt-8 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[1280px] mx-auto">
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
            
            <!-- Sidebar / Filters -->
            <aside class="w-full lg:w-1/4 shrink-0">
                <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-6 sticky top-24 shadow-sm">
                    <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-6">Filters</h2>
                    
                    <!-- Duration -->
                    <div class="mb-8">
                        <h3 class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">Duration</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDuration" value="" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Semua Durasi</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDuration" value="Half Day" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Half Day</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDuration" value="Full Day" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Full Day</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedDuration" value="2 Days 1 Night" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">2 Days 1 Night</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <h3 class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">Price Range</h3>
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedPrice" value="" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Semua Harga</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedPrice" value="0-250000" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">< Rp 250.000</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedPrice" value="250000-500000" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Rp 250.000 - Rp 500.000</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedPrice" value="500000-1000000" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Rp 500.000 - Rp 1.000.000</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" wire:model.live="selectedPrice" value="1000000+" class="w-5 h-5 rounded-full border-outline-variant text-primary focus:ring-primary">
                                <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">> Rp 1.000.000</span>
                            </label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="w-full lg:w-3/4 flex flex-col">
                
                <!-- Loading State -->
                <div wire:loading.flex class="justify-center items-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
                </div>

                <!-- Grid -->
                <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($packages as $index => $package)
                        
                        @if($package->is_popular || $index === 0)
                            <!-- Horizontal Card (Popular or First Item) -->
                            <div class="md:col-span-2 bg-white rounded-2xl overflow-hidden border border-outline-variant/30 flex flex-col md:flex-row group shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="w-full md:w-1/2 relative h-[250px] md:h-auto shrink-0">
                                    @if($package->is_popular)
                                        <div class="absolute top-4 left-4 z-10 bg-primary text-on-primary px-3 py-1 rounded-full font-label-sm font-semibold flex items-center gap-1 shadow-md">
                                            <span class="material-symbols-outlined text-[16px]">star</span>
                                            Most Popular
                                        </div>
                                    @endif
                                    
                                    @if($package->image)
                                        <img loading="lazy" src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-surface-container-high"></div>
                                    @endif
                                </div>
                                <div class="w-full md:w-1/2 p-6 md:p-8 flex flex-col justify-center">
                                    <h3 class="font-display-sm text-display-sm font-bold text-on-surface mb-3">{{ $package->name }}</h3>
                                    <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-3">{{ strip_tags($package->description) }}</p>
                                    
                                    <div class="flex items-center gap-6 mb-8 text-on-surface-variant font-label-md">
                                        @if($package->duration)
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[18px]">schedule</span>
                                            {{ $package->duration }}
                                        </div>
                                        @endif
                                        @if($package->max_pax)
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[18px]">group</span>
                                            {{ $package->max_pax }}
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-end justify-between mt-auto">
                                        <div>
                                            <div class="text-on-surface-variant font-label-sm mb-1">Mulai dari</div>
                                            <div class="font-headline-md text-headline-md font-bold text-primary">Rp{{ number_format($package->price, 0, ',', '.') }}<span class="font-body-sm text-on-surface-variant font-normal"> /orang</span></div>
                                        </div>
                                        <a href="{{ $package->link_url ?? url('/packages/'.$package->slug) }}" class="px-6 py-2.5 bg-primary text-on-primary rounded-lg font-label-md font-semibold hover:bg-primary/90 transition-colors shadow-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Vertical Card (Standard) -->
                            <div class="bg-white rounded-2xl overflow-hidden border border-outline-variant/30 flex flex-col group shadow-sm hover:shadow-md transition-shadow duration-300">
                                <div class="relative h-[200px] shrink-0 overflow-hidden">
                                    @if($package->image)
                                        <img loading="lazy" src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-surface-container-high"></div>
                                    @endif
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-2">{{ $package->name }}</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-6 line-clamp-2">{{ strip_tags($package->description) }}</p>
                                    
                                    @if($package->duration)
                                    <div class="flex items-center gap-2 text-on-surface-variant font-label-sm mb-6">
                                        <span class="material-symbols-outlined text-[16px]">schedule</span>
                                        {{ $package->duration }}
                                    </div>
                                    @endif
                                    
                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="font-headline-sm text-headline-sm font-bold text-primary">Rp{{ number_format($package->price, 0, ',', '.') }}</div>
                                        <a href="{{ $package->link_url ?? url('/packages/'.$package->slug) }}" class="px-5 py-2 border border-primary text-primary rounded-lg font-label-sm font-semibold hover:bg-primary/5 transition-colors">Details</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <div class="md:col-span-2 py-12 flex flex-col items-center justify-center border-2 border-dashed border-outline-variant rounded-2xl">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">search_off</span>
                            <h3 class="font-headline-sm text-on-surface mb-2">Belum ada paket wisata</h3>
                            <p class="text-on-surface-variant text-center max-w-[448px]">Saat ini belum ada paket wisata yang tersedia atau sesuai dengan filter Anda.</p>
                            <button wire:click="$set('selectedDuration', ''); $set('selectedPrice', '')" class="mt-4 px-6 py-2 bg-primary text-on-primary rounded-lg hover:opacity-90">Clear Filters</button>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $packages->links(data: ['scrollTo' => false]) }}
                </div>
            </div>
            
        </div>
    </div>
</div>
