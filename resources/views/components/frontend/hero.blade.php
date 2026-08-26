@props(['slides' => []])

<section class="relative h-[751px] w-full flex items-center justify-center overflow-hidden" id="hero-slider">
    @if(count($slides) > 0)
        @foreach($slides as $index => $slide)
            <div class="absolute inset-0 z-0 hero-slide transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ Storage::url($slide->image) }}')"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative z-10 px-gutter text-center max-w-4xl mx-auto">
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
            <div class="absolute bottom-8 left-0 right-0 flex justify-center gap-2 z-20">
                @foreach($slides as $index => $slide)
                    <button class="w-3 h-3 rounded-full hero-dot transition-colors {{ $index === 0 ? 'bg-primary' : 'bg-white/50 hover:bg-white/80' }}" onclick="goToSlide({{ $index }})"></button>
                @endforeach
            </div>

            <script>
                let currentSlide = 0;
                const slides = document.querySelectorAll('.hero-slide');
                const dots = document.querySelectorAll('.hero-dot');
                const totalSlides = slides.length;

                function goToSlide(index) {
                    slides[currentSlide].classList.remove('opacity-100');
                    slides[currentSlide].classList.add('opacity-0');
                    dots[currentSlide].classList.remove('bg-primary');
                    dots[currentSlide].classList.add('bg-white/50');
                    
                    currentSlide = index;
                    
                    slides[currentSlide].classList.remove('opacity-0');
                    slides[currentSlide].classList.add('opacity-100');
                    dots[currentSlide].classList.remove('bg-white/50');
                    dots[currentSlide].classList.add('bg-primary');
                }

                setInterval(() => {
                    const nextSlide = (currentSlide + 1) % totalSlides;
                    goToSlide(nextSlide);
                }, 5000);
            </script>
        @endif
    @else
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-surface-variant flex items-center justify-center">
                <span class="text-on-surface-variant">No Hero Image Available</span>
            </div>
        </div>
    @endif
</section>
