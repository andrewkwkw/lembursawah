<div>
    <!-- Hero Banner -->
    <section class="relative w-full pt-32 pb-24 px-4 md:px-8 overflow-hidden rounded-b-[3rem] bg-surface-container-high">
        @if($featuredEvent && $featuredEvent->image)
            <img loading="lazy" src="{{ asset('storage/' . $featuredEvent->image) }}" alt="{{ $featuredEvent->title }}" class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 w-full h-full bg-primary/20"></div>
        @endif
        
        <div class="absolute inset-0 w-full h-full bg-gradient-to-t from-black/90 via-black/40 to-black/20"></div>
        
        <div class="relative z-10 w-full max-w-[1280px] mx-auto flex flex-col justify-end h-full min-h-[400px]">
            @if($featuredEvent)
                @if($featuredEvent->category)
                    <span class="inline-block self-start px-3 py-1 bg-primary text-on-primary rounded-full font-label-sm font-bold tracking-wide uppercase mb-4 shadow-sm">
                        {{ $featuredEvent->category }}
                    </span>
                @else
                    <span class="inline-block self-start px-3 py-1 bg-primary text-on-primary rounded-full font-label-sm font-bold tracking-wide uppercase mb-4 shadow-sm">
                        Featured Event
                    </span>
                @endif
                
                <h1 class="font-display-lg md:font-display-xl text-white font-bold mb-4">
                    {{ $featuredEvent->title }}
                </h1>
                
                <div class="font-body-lg text-white/90 max-w-[768px] mb-6 line-clamp-2">
                    {!! strip_tags($featuredEvent->description) !!}
                </div>
                
                <div class="flex flex-wrap items-center gap-6 mb-8 text-white/90">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">calendar_month</span>
                        <span class="font-label-md">{{ $featuredEvent->start_date->format('F d, Y') }}</span>
                    </div>
                    @if($featuredEvent->location)
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">location_on</span>
                        <span class="font-label-md">{{ $featuredEvent->location }}</span>
                    </div>
                    @endif
                </div>

                @if($featuredEvent->registration_url)
                    <a href="{{ $featuredEvent->registration_url }}" target="_blank" class="self-start inline-flex items-center gap-2 px-6 py-3 bg-primary text-on-primary rounded-xl font-label-lg font-bold hover:bg-primary/90 transition-colors shadow-lg active:scale-95">
                        Register Now
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </a>
                @endif
            @else
                <div class="w-full">
                    <h1 class="font-display-lg md:font-display-xl text-white font-bold mb-4">
                        Upcoming Agendas
                    </h1>
                    <p class="font-body-lg text-white/90 max-w-[768px] mb-6">
                        Discover events and activities happening in our community.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content -->
    <section class="max-w-[1280px] mx-auto px-4 md:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Column: Calendar Widget -->
            <div class="lg:col-span-1">
                <div class="bg-surface border border-outline-variant/30 rounded-3xl p-6 shadow-sm">
                    <!-- Calendar Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-headline-sm font-bold text-on-surface">
                            {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}
                        </h2>
                        <div class="flex items-center gap-2">
                            <button wire:click="previousMonth" class="p-2 rounded-full hover:bg-surface-variant/30 text-on-surface-variant transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">chevron_left</span>
                            </button>
                            <button wire:click="nextMonth" class="p-2 rounded-full hover:bg-surface-variant/30 text-on-surface-variant transition-colors flex items-center justify-center">
                                <span class="material-symbols-outlined text-xl">chevron_right</span>
                            </button>
                        </div>
                    </div>

                    <!-- Days of Week -->
                    <div class="grid grid-cols-7 gap-1 mb-4 text-center">
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayOfWeek)
                            <div class="font-label-sm text-on-surface-variant font-medium">{{ $dayOfWeek }}</div>
                        @endforeach
                    </div>

                    <!-- Calendar Grid -->
                    <div class="grid grid-cols-7 gap-1">
                        @foreach($calendar as $day)
                            @if($day === null)
                                <div class="aspect-square"></div>
                            @else
                                @php
                                    $isSelected = $selectedDate === $day['date'];
                                    $isToday = \Carbon\Carbon::parse($day['date'])->isToday();
                                @endphp
                                <button wire:click="selectDate('{{ $day['date'] }}')" 
                                        class="relative aspect-square flex flex-col items-center justify-center rounded-2xl transition-all duration-200 
                                            {{ $isSelected ? 'bg-primary-container text-on-primary-container shadow-md border-2 border-primary scale-105' : 'hover:bg-surface-variant/30 text-on-surface' }}
                                            {{ $isToday && !$isSelected ? 'border border-primary text-primary font-bold' : '' }}">
                                    
                                    <span class="font-label-md {{ $isSelected || $isToday ? 'font-bold' : 'font-medium' }}">{{ $day['day'] }}</span>
                                    
                                    @if($day['hasEvent'])
                                        <div class="absolute bottom-2 flex gap-1">
                                            <div class="w-1.5 h-1.5 rounded-full {{ $isSelected ? 'bg-primary' : 'bg-tertiary' }}"></div>
                                        </div>
                                    @endif
                                </button>
                            @endif
                        @endforeach
                    </div>
                    
                    @if($selectedDate)
                    <div class="mt-6 flex justify-center">
                        <button wire:click="$set('selectedDate', null)" class="text-sm text-primary font-medium hover:underline">
                            Clear Filter
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Events List -->
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-headline-md font-bold text-on-surface">
                        {{ $selectedDate ? 'Events on ' . \Carbon\Carbon::parse($selectedDate)->format('F d, Y') : 'Upcoming Events' }}
                    </h2>
                    @if(!$selectedDate)
                        <span class="text-on-surface-variant font-label-md">Page {{ $events->currentPage() }}</span>
                    @endif
                </div>

                <div class="flex flex-col gap-6">
                    @forelse($events as $event)
                        <div class="bg-white border border-outline-variant/30 rounded-3xl p-4 md:p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start">
                            
                            <!-- Date Box -->
                            <div class="bg-surface-container-low rounded-2xl p-4 min-w-[100px] flex flex-col items-center justify-center shrink-0 border border-outline-variant/20">
                                <span class="font-label-md text-on-surface-variant uppercase tracking-wider mb-1">{{ $event->start_date->format('M') }}</span>
                                <span class="font-display-md font-bold text-primary">{{ $event->start_date->format('d') }}</span>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 w-full">
                                <div class="flex flex-wrap items-center gap-3 mb-3">
                                    @if($event->category)
                                        <span class="px-3 py-1 bg-tertiary-container text-on-tertiary-container rounded-full font-label-sm font-bold uppercase tracking-wide">
                                            {{ $event->category }}
                                        </span>
                                    @endif
                                    
                                    @if($event->status)
                                        @php
                                            // Simple logic for coloring status
                                            $statusLower = strtolower($event->status);
                                            $statusColor = 'text-primary';
                                            if(str_contains($statusLower, 'fully') || str_contains($statusLower, 'closed') || str_contains($statusLower, 'sold')) {
                                                $statusColor = 'text-error';
                                            }
                                        @endphp
                                        <span class="font-label-sm font-semibold {{ $statusColor }} ml-auto md:ml-0 md:mr-auto">
                                            {{ $event->status }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="font-headline-sm font-bold text-on-surface mb-2">{{ $event->title }}</h3>
                                
                                <div class="font-body-md text-on-surface-variant line-clamp-2 mb-4">
                                    {!! strip_tags($event->description) !!}
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mt-auto">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-sm">schedule</span>
                                            <span class="font-label-sm">{{ $event->start_date->format('h:i A') }}</span>
                                        </div>
                                        @if($event->location)
                                        <div class="flex items-center gap-2 text-on-surface-variant">
                                            <span class="material-symbols-outlined text-sm">location_on</span>
                                            <span class="font-label-sm">{{ $event->location }}</span>
                                        </div>
                                        @endif
                                    </div>
                                    
                                    @if($event->registration_url)
                                        <a href="{{ $event->registration_url }}" target="_blank" class="inline-flex items-center justify-center px-5 py-2 bg-primary text-on-primary rounded-xl font-label-md font-semibold hover:bg-primary/90 transition-colors active:scale-95 whitespace-nowrap">
                                            Register
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 flex flex-col items-center justify-center text-center bg-surface border border-dashed border-outline-variant/50 rounded-3xl">
                            <span class="material-symbols-outlined text-5xl text-on-surface-variant/50 mb-4">event_busy</span>
                            <h3 class="font-headline-sm font-bold text-on-surface mb-2">No Events Found</h3>
                            <p class="font-body-md text-on-surface-variant">
                                {{ $selectedDate ? 'There are no events scheduled for this date.' : 'Check back later for upcoming events.' }}
                            </p>
                        </div>
                    @endforelse

                    @if($events->hasPages() && !$selectedDate)
                        <div class="mt-8">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>