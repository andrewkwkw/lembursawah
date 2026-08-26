<x-layouts.app title="Beranda - Lembur Sawah">
    @if(isset($heroSlides) && count($heroSlides) > 0)
        <x-frontend.hero :slides="$heroSlides" />
    @else
        <section class="relative h-[819px] min-h-[600px] w-full flex items-center justify-center">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 w-full h-full bg-primary/20"></div>
                <div class="absolute inset-0 bg-black/30"></div>
            </div>
            <div class="relative z-10 text-center text-white px-4 md:px-8 w-full max-w-[1280px] mx-auto flex flex-col items-center justify-center">
                <h1 class="font-display-lg text-display-lg text-white mb-6 shadow-sm">
                    Discover the Serenity of Nature
                </h1>
                <p class="font-body-lg text-body-lg w-full max-w-[700px] mb-8 text-white/90">
                    Experience the tranquil beauty, rich culture, and sustainable tourism of Lembur Sawah. Your journey into the heart of natural heritage begins here.
                </p>
            </div>
        </section>
    @endif
    <section class="py-3xl px-gutter max-w-container-max mx-auto">
        <div class="mb-2xl flex justify-between items-end">
            <div>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-sm">Top Destinations</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Explore the most beloved spots in our village.</p>
            </div>
            <a class="font-label-md text-label-md text-primary hover:underline flex items-center gap-1 hidden md:flex" href="{{ url('/destinations') }}">
                View all <span class="material-symbols-outlined text-[18px]">chevron_right</span>
            </a>
        </div>
        
        @php 
            $topAttractions = isset($attractions) ? $attractions->take(3) : collect(); 
        @endphp
        
        @if($topAttractions->isEmpty())
            <div class="flex items-center justify-center h-[300px] border-2 border-dashed border-outline-variant rounded-xl bg-surface-container-low">
                <p class="font-body-lg text-body-lg text-on-surface-variant italic">Belum ada top destinasi</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-12 gap-lg h-auto md:h-[600px]">
                @php $card1 = $topAttractions->get(0); @endphp
                @if($card1)
                <a href="{{ url('/destinations/' . $card1->id) }}" class="md:col-span-8 relative rounded-xl overflow-hidden group cursor-pointer h-[300px] md:h-full shadow-sm hover:shadow-md transition-shadow duration-300 block">
                    <img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $card1->name }}" src="{{ Storage::url($card1->image) }}"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-lg w-full">
                        <span class="inline-block bg-primary-container text-on-primary-container font-label-sm text-label-sm px-2 py-1 rounded-full mb-2">Must Visit</span>
                        <h3 class="font-headline-sm text-headline-sm text-white mb-1">{{ $card1->name }}</h3>
                        <p class="font-body-sm text-body-sm text-white/80 line-clamp-2">{{ Str::limit(strip_tags($card1->description), 100) }}</p>
                    </div>
                </a>
                @endif
                <div class="md:col-span-4 flex flex-col gap-lg h-[600px] md:h-full">
                    @php $card2 = $topAttractions->get(1); @endphp
                    @if($card2)
                    <a href="{{ url('/destinations/' . $card2->id) }}" class="relative rounded-xl overflow-hidden group cursor-pointer flex-1 shadow-sm hover:shadow-md transition-shadow duration-300 block">
                        <img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $card2->name }}" src="{{ Storage::url($card2->image) }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-lg w-full">
                            <h3 class="font-headline-sm text-headline-sm text-white mb-1">{{ $card2->name }}</h3>
                            <p class="font-body-sm text-body-sm text-white/80 line-clamp-1">{{ Str::limit(strip_tags($card2->description), 50) }}</p>
                        </div>
                    </a>
                    @endif
                    @php $card3 = $topAttractions->get(2); @endphp
                    @if($card3)
                    <a href="{{ url('/destinations/' . $card3->id) }}" class="relative rounded-xl overflow-hidden group cursor-pointer flex-1 shadow-sm hover:shadow-md transition-shadow duration-300 block">
                        <img loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $card3->name }}" src="{{ Storage::url($card3->image) }}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-lg w-full">
                            <h3 class="font-headline-sm text-headline-sm text-white mb-1">{{ $card3->name }}</h3>
                            <p class="font-body-sm text-body-sm text-white/80 line-clamp-1">{{ Str::limit(strip_tags($card3->description), 50) }}</p>
                        </div>
                    </a>
                    @endif

                </div>
            </div>
        @endif
    </section>

</x-layouts.app>
