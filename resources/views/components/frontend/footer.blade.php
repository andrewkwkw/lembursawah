<footer class="w-full py-12 bg-white mt-16 border-t border-outline-variant/30">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-4 md:px-8 max-w-[1280px] mx-auto">
        <div class="col-span-1 md:col-span-2">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Lembur Sawah" class="h-10 w-auto mb-4">
            <p class="font-body-md text-body-md text-primary-container/80 max-w-[384px] mb-6">Berdedikasi untuk melestarikan keindahan alam dan mempromosikan pariwisata berkelanjutan sambil memberikan pelayanan publik yang transparan.</p>
            <div class="font-label-sm text-label-sm text-primary-container/70">
                &copy; {{ date('Y') }} Lembur Sawah. Hak cipta dilindungi undang-undang.
            </div>
        </div>
        <div class="col-span-1">
            <h4 class="font-label-md text-label-md text-primary-container font-semibold mb-6">Jelajahi</h4>
            <ul class="flex flex-col gap-2">
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/destinations') }}">Destinasi</a></li>
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/packages') }}">Paket Tour</a></li>
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/gallery') }}">Galeri</a></li>
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/market') }}">Produk</a></li>
            </ul>
        </div>
        <div class="col-span-1">
            <h4 class="font-label-md text-label-md text-primary-container font-semibold mb-6">Informasi</h4>
            <ul class="flex flex-col gap-2">
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/map') }}">Peta</a></li>
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/articles') }}">Artikel</a></li>
                <li><a wire:navigate class="font-body-sm text-body-sm text-primary-container/80 hover:text-primary-container transition-colors cursor-pointer" href="{{ url('/faq') }}">FAQ</a></li>
            </ul>
        </div>
    </div>
</footer>
