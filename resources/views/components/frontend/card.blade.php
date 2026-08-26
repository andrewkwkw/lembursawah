@props(['image', 'title', 'subtitle' => '', 'link' => '#', 'badge' => null])

<a href="{{ $link }}" class="block min-w-[280px] w-[280px] md:w-auto bg-surface-container-low rounded-xl overflow-hidden shadow-sm flex-shrink-0 group cursor-pointer hover:shadow-md transition-shadow">
    <div class="h-40 w-full bg-cover bg-center relative" style="background-image: url('{{ $image }}')">
        @if($badge)
            <div class="absolute top-sm right-sm bg-primary text-white text-xs px-2 py-1 rounded-full font-bold">
                {{ $badge }}
            </div>
        @endif
    </div>
    <div class="p-md">
        <h4 class="font-label-md text-label-md font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2">{{ $title }}</h4>
        @if($subtitle)
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-xs line-clamp-2">{!! Str::limit(strip_tags($subtitle), 80) !!}</p>
        @endif
    </div>
</a>
