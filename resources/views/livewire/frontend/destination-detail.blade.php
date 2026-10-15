<div class="pt-24 pb-16 min-h-screen bg-surface">
    <div class="px-4 md:px-8 max-w-[1024px] mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm font-medium text-on-surface-variant">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/destinations') }}" class="hover:text-primary transition-colors">Destinasi</a>
            <span class="mx-2">/</span>
            <span class="text-on-surface">{{ $destination->name }}</span>
        </nav>

        <!-- Hero Section -->
        <div class="relative w-full h-[400px] md:h-[500px] rounded-2xl overflow-hidden mb-12 shadow-md">
            @if($destination->image)
                <img loading="lazy" src="{{ Storage::url($destination->image) }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-outline">landscape</span>
                </div>
            @endif
        </div>

        <!-- Content -->
        <div class="flex flex-col md:flex-row gap-12">
            <!-- Main Details -->
            <div class="flex-1">
                <div class="mb-6 flex items-center gap-3">
                    @if($destination->category)
                        <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold bg-primary-container text-on-primary-container">
                            {{ $destination->category }}
                        </span>
                    @endif
                </div>
                
                <h1 class="font-display-lg text-4xl md:text-5xl font-bold text-on-surface mb-6">{{ $destination->name }}</h1>
                
                <div class="prose prose-lg text-on-surface-variant max-w-none">
                    {!! \Stevebauman\Purify\Facades\Purify::clean($destination->description) !!}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-[350px] shrink-0">
                <div class="bg-surface-container-lowest border border-outline-variant/30 rounded-2xl p-6 sticky top-24 shadow-sm">
                    <h3 class="font-headline-sm font-bold text-on-surface mb-6">Informasi Kunjungan</h3>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex gap-3 text-on-surface-variant">
                            <span class="material-symbols-outlined text-primary shrink-0">location_on</span>
                            <span>{{ $destination->address ?? 'Lembur Sawah, Jawa Barat' }}</span>
                        </li>
                    </ul>

                    @php
                        $rawWa = \App\Models\Setting::where('key', 'whatsapp_number')->value('value') ?? '6281234567890';
                        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
                        if (str_starts_with($cleanWa, '0')) {
                            $cleanWa = '62' . substr($cleanWa, 1);
                        }
                        $waMessage = urlencode("Halo admin Lembur Sawah, saya ingin menanyakan informasi tentang destinasi " . $destination->name);
                        $waLink = "https://wa.me/{$cleanWa}?text={$waMessage}";
                    @endphp

                    <a href="{{ $waLink }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#128C7E] text-white font-bold py-3 px-6 rounded-xl transition-colors shadow-sm">
                        <span class="material-symbols-outlined">chat</span>
                        Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
