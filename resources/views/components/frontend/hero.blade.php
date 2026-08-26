@props(['slides' => []])

<section class="relative h-[751px] w-full flex items-center justify-center overflow-hidden" 
         id="hero-slider"
         x-data="{ 
             activeSlide: 0, 
             totalSlides: {{ count($slides) }},
             intervalId: null,
             init() {
                 if (this.totalSlides > 1) {
                     this.intervalId = setInterval(() => {
                         // Hanya ganti slide jika tab sedang aktif dilihat pengunjung
                         if (document.visibilityState === 'visible') {
                             this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                         }
                     }, 5000);
                     
                     // Bersihkan memori saat pengunjung pindah ke halaman lain
                     this.$cleanup(() => clearInterval(this.intervalId));
                 }
             }
         }">
    
    @if(count($slides) > 0)
        @foreach($slides as $index => $slide)
            <div class="absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                 :class="activeSlide === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ Storage::url($slide->image) }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative z-20 px-gutter text-center max-w-4xl mx-auto">
                        <h2 class="text-white font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg mb-md drop-shadow-lg leading-tight">
                            {{ $slide->title }}
                        </h2>
                        @if($slide->subtitle)
                            <p class="text-white/90 font-body-lg text-body-lg mb-xl drop-shadow-md">
                                {{ $slide->subtitle }}
                            </p>
                        @endif
                        @if($slide->button_text)
                            <a href="{{ $slide->button_link ?? '#' }}" class="inline-block bg-primary hover:bg-primary-container text-white px-xl py-md rounded-xl font-label-md text-label-md transition-all active:scale-95 shadow-lg">
                                {{ $slide->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($slides) > 1)
            <div class="absolute bottom-8 left-0 right-0 flex justify-center gap-2 z-30">
                @foreach($slides as $index => $slide)
                    <button class="w-3 h-3 rounded-full transition-colors" 
                            :class="activeSlide === {{ $index }} ? 'bg-primary' : 'bg-white/50 hover:bg-white/80'" 
                            @click="activeSlide = {{ $index }}"></button>
                @endforeach
            </div>
        @endif
    @else
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-surface-variant flex items-center justify-center">
                <span class="text-on-surface-variant">No Hero Image Available</span>
            </div>
        </div>
    @endif
</section>
