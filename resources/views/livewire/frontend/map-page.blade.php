<div class="min-h-screen bg-surface flex flex-col pt-24 pb-12">
    <script>
        window.globalMapPoints = @json($mapPoints);
        window.mapMarkers = [];
        window.leafletMap = null;

        window.mapModal = function() {
            return {
                isOpen: false,
                point: null,
                safeDescription: '',
                init() {
                    window.addEventListener('open-map-modal', (e) => this.openModal(e.detail));
                },
                sanitizeHtml(html) {
                    if (!html) return '';
                    const allowed = ['P','BR','STRONG','EM','UL','OL','LI','H1','H2','H3','H4','H5','H6','A','SPAN','DIV'];
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const walk = (node) => {
                        for (const child of Array.from(node.childNodes)) {
                            if (child.nodeType === 1) {
                                if (!allowed.includes(child.tagName)) {
                                    child.replaceWith(document.createTextNode(child.textContent));
                                } else {
                                    for (const attr of Array.from(child.attributes)) {
                                        if (attr.name.startsWith('on')) child.removeAttribute(attr.name);
                                    }
                                    if (child.tagName === 'A') {
                                        child.setAttribute('rel', 'noopener noreferrer');
                                        child.setAttribute('target', '_blank');
                                    }
                                    walk(child);
                                }
                            }
                        }
                    };
                    walk(doc.body);
                    return doc.body.innerHTML;
                },
                openModal(pointData) {
                    this.point = pointData;
                    this.safeDescription = this.sanitizeHtml(pointData?.description || '');
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                    
                    if(this.point && this.point.street_view_embed_url) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(this.point.street_view_embed_url, 'text/html');
                        const iframe = doc.querySelector('iframe');
                        if(iframe && iframe.src && iframe.src.includes('google.com/maps')) {
                            const safeIframe = document.createElement('iframe');
                            safeIframe.src = iframe.src;
                            safeIframe.style.cssText = 'width:100%;height:100%;border:none;position:absolute;top:0;left:0;';
                            safeIframe.setAttribute('allowfullscreen', '');
                            safeIframe.setAttribute('loading', 'lazy');
                            safeIframe.setAttribute('referrerpolicy', 'no-referrer-when-downgrade');
                            this.$refs.streetViewContainer.innerHTML = '';
                            this.$refs.streetViewContainer.appendChild(safeIframe);
                        } else {
                            this.$refs.streetViewContainer.innerHTML = '<div class="w-full h-full flex flex-col items-center justify-center bg-surface-variant/50"><span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-2">location_off</span><span class="text-on-surface-variant/50 font-body-md">URL embed tidak valid</span></div>';
                        }
                    } else {
                        this.$refs.streetViewContainer.innerHTML = '<div class="w-full h-full flex flex-col items-center justify-center bg-surface-variant/50"><span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-2">location_off</span><span class="text-on-surface-variant/50 font-body-md">Tidak ada tampilan Street View</span></div>';
                    }
                },
                closeModal() {
                    this.isOpen = false;
                    document.body.style.overflow = ''; 
                    setTimeout(() => {
                        if (this.$refs.streetViewContainer) {
                            this.$refs.streetViewContainer.innerHTML = '';
                        }
                    }, 300);
                }
            };
        };

        if (window.Alpine) {
            window.Alpine.data('mapModal', window.mapModal);
        } else {
            document.addEventListener('alpine:init', () => {
                window.Alpine.data('mapModal', window.mapModal);
            });
        }

        function initLeafletMap() {
            const mapContainer = document.getElementById('map');
            if (!mapContainer) return;

            if (typeof L === 'undefined') {
                setTimeout(initLeafletMap, 200);
                return;
            }

            if (mapContainer._leaflet_id) {
                mapContainer._leaflet_id = null;
            }

            if (window.leafletMap) {
                try {
                    window.leafletMap.remove();
                } catch(e) {}
                window.leafletMap = null;
            }
            window.mapMarkers = [];

            const map = L.map('map', { scrollWheelZoom: false }).setView([-6.8286, 107.9253], 14);
            window.leafletMap = map;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const points = window.globalMapPoints || [];
            const latLngs = [];

            points.forEach((point, index) => {
                if (point.coordinate_x && point.coordinate_y) {
                    const lat = parseFloat(point.coordinate_x);
                    const lng = parseFloat(point.coordinate_y);
                    
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const marker = L.marker([lat, lng]).addTo(map);
                        latLngs.push([lat, lng]);
                        window.mapMarkers[index] = marker;
                        
                        marker.on('click', () => {
                            window.dispatchEvent(new CustomEvent('open-map-modal', { detail: point }));
                        });
                    }
                }
            });

            if (latLngs.length > 0) {
                const bounds = L.latLngBounds(latLngs);
                map.fitBounds(bounds, { padding: [50, 50] });
            }
            
            map.on('focus', function() { map.scrollWheelZoom.enable(); });
            map.on('blur', function() { map.scrollWheelZoom.disable(); });

            setTimeout(() => {
                if (window.leafletMap) {
                    window.leafletMap.invalidateSize();
                }
            }, 200);
            setTimeout(() => {
                if (window.leafletMap) {
                    window.leafletMap.invalidateSize();
                }
            }, 500);
        }

        document.addEventListener('livewire:navigated', () => {
            setTimeout(initLeafletMap, 100);
        });
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(initLeafletMap, 100);
            });
        } else {
            setTimeout(initLeafletMap, 100);
        }

        function focusMarker(index) {
            if(window.mapMarkers && window.mapMarkers[index] && window.leafletMap) {
                const latLng = window.mapMarkers[index].getLatLng();
                window.leafletMap.setView(latLng, 17, { animate: true, duration: 1 });
                const points = window.globalMapPoints || [];
                if (points[index]) {
                    window.dispatchEvent(new CustomEvent('open-map-modal', { detail: points[index] }));
                }
            }
        }
    </script>

    <!-- Header -->
    <div class="px-4 md:px-8 max-w-[1280px] mx-auto w-full mb-8 mt-8">
        <div class="text-center md:text-left">
            <h1 class="font-display-lg md:font-display-xl font-bold text-primary mb-4">
                Peta Desa Wisata
            </h1>
            <p class="font-body-lg text-on-surface-variant w-full max-w-[768px]">
                Jelajahi berbagai lokasi menarik, fasilitas, dan keindahan alam di Lembur Sawah. Temukan destinasi favorit Anda melalui peta interaktif ini.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 md:px-8 max-w-[1280px] mx-auto w-full flex-1 flex flex-col md:flex-row gap-6">
        
        <!-- Sidebar: List of Locations -->
        <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col gap-4 max-h-[800px] overflow-y-auto custom-scrollbar pr-2">
            @foreach($mapPoints as $index => $point)
                <div class="bg-white border border-outline-variant/30 rounded-xl p-4 cursor-pointer hover:border-primary-container hover:shadow-md transition-all duration-300 group" onclick="focusMarker({{ $index }})">
                    <h3 class="font-headline-sm text-lg font-bold text-primary-container mb-1 group-hover:text-primary transition-colors">{{ $point->name }}</h3>
                    <div class="font-body-sm text-on-surface-variant line-clamp-2">
                        {{ strip_tags($point->description) }}
                    </div>
                    <div class="mt-3 flex items-center gap-1 text-primary-container/70 text-xs font-semibold">
                        <span class="material-symbols-outlined text-[16px]">map</span>
                        Lihat di Peta
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Map Container -->
        <div class="w-full md:w-2/3 lg:w-3/4 bg-white rounded-3xl overflow-hidden shadow-lg border border-outline-variant/20 relative" style="min-height: 800px; height: 80vh;">
            <div id="map" class="absolute inset-0 w-full h-full z-0"></div>
        </div>
        
    </div>

    <!-- Full Screen Modal -->
    <div x-data="mapModal()" 
         x-show="isOpen" 
         x-transition.opacity.duration.300ms
         style="display: none;" 
         class="fixed inset-0 z-[9999] bg-surface/95 backdrop-blur-md flex flex-col">
         
        <!-- Header with Close Button -->
        <div class="flex items-center justify-between p-4 md:px-8 md:py-5 border-b border-outline-variant/30 bg-white shadow-sm">
            <h2 class="font-display-sm text-xl md:text-3xl font-bold text-primary" x-text="point?.name"></h2>
            <button @click="closeModal()" class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-variant hover:bg-error/10 hover:text-error transition-colors focus:outline-none">
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
        </div>

        <!-- Content: 2 Columns on Desktop, 1 on Mobile -->
        <div class="flex-1 overflow-hidden flex flex-col md:flex-row">
            <!-- Street View / Media (Left) -->
            <div class="w-full md:w-2/3 h-1/2 md:h-full bg-black relative shadow-inner" x-ref="streetViewContainer">
                <!-- Iframe injected here -->
            </div>

            <!-- Description (Right) -->
            <div class="w-full md:w-1/3 h-1/2 md:h-full overflow-y-auto p-6 md:p-10 bg-white border-l border-outline-variant/30 custom-scrollbar">
                <div class="flex items-center gap-3 mb-6">
                    <span class="material-symbols-outlined text-primary-container text-3xl">info</span>
                    <h3 class="font-headline-sm font-bold text-primary-container text-2xl">Tentang Lokasi</h3>
                </div>
                <div class="prose prose-lg text-on-surface-variant" x-html="safeDescription"></div>
            </div>
        </div>
    </div>
    
    <style>
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    </style>
</div>
