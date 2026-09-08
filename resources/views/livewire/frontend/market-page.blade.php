<div class="min-h-screen bg-surface">
    <div class="pt-24 pb-8 bg-surface"></div>

    <main class="max-w-[1280px] mx-auto px-4 md:px-8 pb-16">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="w-full lg:w-1/4 flex flex-col gap-6">
                <div class="bg-white rounded-2xl p-6 border border-outline-variant/30 shadow-sm">
                    <h3 class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">Pencarian</h3>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari produk UMKM..." class="w-full pl-12 pr-4 py-3 rounded-xl border border-outline-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none font-body-md text-on-surface transition-all">
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-outline-variant/30 shadow-sm">
                    <h3 class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">Kategori</h3>
                    <div class="flex flex-col gap-3">
                        @foreach($categoryCounts as $val => $count)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" wire:model.live="selectedCategories" value="{{ $val }}" class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">{{ $val }} ({{ $count }})</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-outline-variant/30 shadow-sm">
                    <h3 class="font-label-md text-label-md font-bold text-on-surface-variant uppercase tracking-wider mb-4">Rentang Harga</h3>
                    <div class="flex flex-col gap-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price_range" wire:model.live="selectedPrice" value="" class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Semua Harga</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price_range" wire:model.live="selectedPrice" value="0-50000" class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">< Rp 50.000</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price_range" wire:model.live="selectedPrice" value="50000-100000" class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Rp 50.000 - Rp 100.000</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="radio" name="price_range" wire:model.live="selectedPrice" value="100000+" class="w-5 h-5 border-outline-variant text-primary focus:ring-primary">
                            <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">> Rp 100.000</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/4 flex flex-col">
                <div wire:loading.class.remove="hidden" class="hidden absolute inset-0 bg-surface/50 z-10 backdrop-blur-[2px]">
                    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
                    </div>
                </div>
                @if($featuredProduct)
                <div class="mb-8 rounded-2xl overflow-hidden relative min-h-[300px] flex items-center shadow-md">
                    @if($featuredProduct->image)
                        <img loading="lazy" src="{{ asset('storage/' . $featuredProduct->image) }}" alt="{{ $featuredProduct->name }}" class="absolute inset-0 w-full h-full object-cover object-center">
                    @else
                        <div class="absolute inset-0 w-full h-full bg-surface-container-high"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
                    
                    <div class="relative z-10 p-8 md:p-12 max-w-[672px] text-white">
                        @if($featuredProduct->badge)
                        <div class="inline-block px-3 py-1 bg-tertiary text-on-tertiary rounded-full font-label-sm font-bold tracking-wide uppercase mb-4 shadow-sm">
                            {{ $featuredProduct->badge }}
                        </div>
                        @endif
                        <h2 class="font-display-md text-display-md font-bold mb-4">{{ $featuredProduct->name }}</h2>
                        <div class="font-body-lg text-body-lg text-white/90 mb-8 line-clamp-2">{!! strip_tags($featuredProduct->description) !!}</div>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $featuredProduct->wa_number) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-xl font-label-lg font-semibold hover:bg-primary/90 transition-colors shadow-sm">
                            Pesan Produk <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative min-h-[400px]">
                    @forelse($products as $product)
                        <div class="bg-white rounded-2xl overflow-hidden border border-outline-variant/30 flex flex-col group shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="relative h-[220px] shrink-0 overflow-hidden">
                                @if($product->image)
                                    <img loading="lazy" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-on-surface-variant/30">image</span>
                                    </div>
                                @endif
                                
                                @if($product->badge)
                                    <div class="absolute top-4 left-4">
                                        <div class="px-3 py-1 bg-tertiary/90 backdrop-blur-sm text-on-tertiary rounded-full font-label-sm font-bold tracking-wide shadow-sm">
                                            {{ $product->badge }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-grow">
                                <div class="flex justify-between items-start gap-2 mb-2">
                                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface line-clamp-1 flex-1" title="{{ $product->name }}">{{ $product->name }}</h3>
                                    <div class="font-label-md text-label-md font-bold text-primary whitespace-nowrap">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="font-body-sm text-body-sm text-on-surface-variant mb-6 line-clamp-2">{!! strip_tags($product->description) !!}</div>
                                
                                <div class="mt-auto">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->wa_number) }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-primary text-primary rounded-lg font-label-md font-semibold hover:bg-primary/5 transition-colors">
                                        <span class="material-symbols-outlined text-[18px]">chat</span>
                                        Pesan via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 md:col-span-2 lg:col-span-3 py-16 flex flex-col items-center justify-center border-2 border-dashed border-outline-variant rounded-2xl">
                            <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-4">inventory_2</span>
                            <h3 class="font-headline-sm text-on-surface mb-2">Belum ada produk</h3>
                            <p class="text-on-surface-variant text-center max-w-[448px]">Saat ini belum ada produk yang tersedia atau sesuai dengan filter Anda.</p>
                            <button wire:click="$set('selectedCategories', []); $set('selectedPrice', ''); $set('search', '')" class="mt-4 px-6 py-2 bg-primary text-on-primary rounded-lg hover:opacity-90">Reset Filter</button>
                        </div>
                    @endforelse
                </div>
                <div class="mt-10 flex justify-center">
                    {{ $products->links() }}
                </div>
            </div>
            
        </div>
    </main>
</div>
