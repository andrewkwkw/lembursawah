<div class="pt-24 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[1024px] mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm font-medium text-on-surface-variant">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/packages') }}" class="hover:text-primary transition-colors">Paket Tour</a>
            <span class="mx-2">/</span>
            <span class="text-on-surface">{{ $package->name }}</span>
        </nav>

        <div class="relative w-full h-[400px] md:h-[500px] rounded-2xl overflow-hidden mb-12 shadow-md group">
            @if($package->image)
                <img loading="lazy" src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            @else
                <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-outline">tour</span>
                </div>
            @endif
        </div>

        <div class="flex flex-col md:flex-row gap-12">
            <div class="flex-1">
                <div class="mb-6 flex items-center gap-3">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-container text-on-primary-container">
                        Paket Pilihan
                    </span>
                </div>
                
                <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-on-surface mb-6">{{ $package->name }}</h1>
                
                <div class="prose prose-lg text-on-surface-variant max-w-none">
                    {!! \Stevebauman\Purify\Facades\Purify::clean($package->description) !!}
                </div>
            </div>

            <div class="w-full md:w-[350px] shrink-0">
                <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-6 sticky top-24 shadow-sm">
                    <h3 class="font-headline-sm font-bold text-on-surface mb-2">Harga Paket</h3>
                    <div class="text-3xl font-bold text-primary mb-6">
                        Rp {{ number_format($package->price, 0, ',', '.') }}
                    </div>
                    
                    @php
                        $waNumber = \App\Models\Setting::where('key', 'whatsapp_number')->first()->value ?? '6281234567890';
                        $waMessage = urlencode("Halo admin Lembur Sawah, saya tertarik memesan Paket Tour: " . $package->name . " seharga Rp " . number_format($package->price, 0, ',', '.') . ".");
                        $waLink = "https://wa.me/{$waNumber}?text={$waMessage}";
                    @endphp

                    <a href="{{ $waLink }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-sm">
                        <span class="material-symbols-outlined">shopping_cart_checkout</span>
                        Pesan Sekarang (WA)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
