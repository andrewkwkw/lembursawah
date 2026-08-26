<header class="fixed top-0 w-full z-50 bg-white shadow-sm border-b border-outline-variant/30">
    <div class="flex justify-between items-center h-16 px-gutter max-w-container-max mx-auto">
        <a href="{{ url('/') }}" class="flex items-center gap-2 cursor-pointer active:scale-95 transition-transform">
            <div class="md:hidden flex items-center">
                <span class="material-symbols-outlined text-primary-container" onclick="event.preventDefault(); toggleDrawer()">menu</span>
            </div>
            <img src="{{ asset('assets/images/logo.webp') }}" alt="Logo" class="h-8 w-auto">
            <span class="font-['Cinzel'] text-2xl font-bold text-primary-container tracking-tight">Lembur Sawah</span>
        </a>
        <nav class="hidden md:flex gap-lg items-center">
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('/') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/') }}">Beranda</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('destinations*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/destinations') }}">Destinasi</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('packages*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/packages') }}">Paket Tour</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('market*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/market') }}">Produk</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('articles*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/articles') }}">Artikel</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('agendas*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/agendas') }}">Agenda</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('gallery*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/gallery') }}">Galeri</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('faq*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/faq') }}">FAQ</a>
            <a wire:navigate class="font-label-md text-label-md {{ request()->is('map*') ? 'text-primary-container border-b-2 border-primary-container pb-1' : 'text-on-surface-variant hover:text-primary-container' }} cursor-pointer active:scale-95 transition-all duration-300 ease-out" href="{{ url('/map') }}">Peta</a>
        </nav>
    </div>
</header>
<div class="fixed inset-0 bg-black/50 z-[60] hidden" id="drawer-overlay" onclick="toggleDrawer()">
    <nav class="h-full w-4/5 max-w-[384px] bg-surface flex flex-col py-6 transform -translate-x-full transition-transform duration-300 shadow-2xl" id="drawer" onclick="event.stopPropagation()">
        <div class="px-6 pb-6 border-b border-outline-variant/30 flex justify-between items-center">
            <h2 class="font-headline-sm text-headline-sm font-bold text-on-surface">Menu</h2>
            <button onclick="toggleDrawer()" class="text-on-surface-variant hover:text-primary-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto flex flex-col py-4">
            <a wire:navigate href="{{ url('/') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('/') ? 'text-primary-container' : 'text-on-surface-variant' }}">Beranda</a>
            <a wire:navigate href="{{ url('/destinations') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('destinations*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Destinasi</a>
            <a wire:navigate href="{{ url('/packages') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('packages*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Paket Tour</a>
            <a wire:navigate href="{{ url('/market') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('market*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Produk</a>
            <a wire:navigate href="{{ url('/articles') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('articles*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Artikel</a>
            <a wire:navigate href="{{ url('/agendas') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('agendas*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Agenda</a>
            <a wire:navigate href="{{ url('/gallery') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('gallery*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Galeri</a>
            <a wire:navigate href="{{ url('/faq') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('faq*') ? 'text-primary-container' : 'text-on-surface-variant' }}">FAQ</a>
            <a wire:navigate href="{{ url('/map') }}" class="px-6 py-4 border-b border-surface-variant font-label-md text-label-md {{ request()->is('map*') ? 'text-primary-container' : 'text-on-surface-variant' }}">Peta</a>
        </div>
    </nav>
</div>
