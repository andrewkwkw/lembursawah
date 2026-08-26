<section class="px-gutter -mt-16 relative z-20">
    <div class="bg-surface-container-lowest p-md rounded-2xl shadow-xl grid grid-cols-4 gap-sm max-w-container-max mx-auto">
        <a href="{{ url('/gallery') }}" class="flex flex-col items-center gap-xs cursor-pointer group hover:scale-105 transition-transform">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined">photo_library</span>
            </div>
            <span class="font-label-sm text-label-sm">Galeri</span>
        </a>
        <a href="{{ url('/map') }}" class="flex flex-col items-center gap-xs cursor-pointer group hover:scale-105 transition-transform">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined">map</span>
            </div>
            <span class="font-label-sm text-label-sm">Peta</span>
        </a>
        <a href="{{ url('/packages') }}" class="flex flex-col items-center gap-xs cursor-pointer group hover:scale-105 transition-transform">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined">redeem</span>
            </div>
            <span class="font-label-sm text-label-sm">Paket</span>
        </a>
        <a href="{{ url('/market') }}" class="flex flex-col items-center gap-xs cursor-pointer group hover:scale-105 transition-transform">
            <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container group-hover:bg-primary group-hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined">storefront</span>
            </div>
            <span class="font-label-sm text-label-sm">Pasar</span>
        </a>
    </div>
</section>
