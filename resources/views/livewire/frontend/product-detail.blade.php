<div class="pt-24 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[1024px] mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm font-medium text-on-surface-variant">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/market') }}" class="hover:text-primary transition-colors">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-on-surface">{{ $product->name }}</span>
        </nav>

        <div class="flex flex-col md:flex-row gap-12">
            <!-- Product Image -->
            <div class="w-full md:w-1/2">
                <div class="relative w-full aspect-square rounded-2xl overflow-hidden shadow-sm group">
                    @if($product->image)
                        <img loading="lazy" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-outline">shopping_bag</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="w-full md:w-1/2 flex flex-col">
                <div class="mb-4">
                    @if($product->category)
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container mb-3">
                            {{ $product->category }}
                        </span>
                    @endif
                    <h1 class="font-display-md text-4xl font-bold text-on-surface mb-2">{{ $product->name }}</h1>
                    <div class="text-3xl font-bold text-primary mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>
                
                <div class="prose prose-md text-on-surface-variant max-w-none mb-8 flex-grow">
                    {!! \Stevebauman\Purify\Facades\Purify::clean($product->description) !!}
                </div>
                
                <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-6 shadow-sm">
                    @php
                        $rawWa = \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6281234567890';
                        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
                        if (str_starts_with($cleanWa, '0')) {
                            $cleanWa = '62' . substr($cleanWa, 1);
                        }
                        $waMessage = urlencode("Halo admin Lembur Sawah, saya tertarik membeli produk: " . $product->name . " seharga Rp " . number_format($product->price, 0, ',', '.') . ".");
                        $waLink = "https://wa.me/{$cleanWa}?text={$waMessage}";
                    @endphp

                    <a href="{{ $waLink }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-sm">
                        <span class="material-symbols-outlined">shopping_cart_checkout</span>
                        Beli via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
