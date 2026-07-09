@props([
    'promos' => [],
])

<section class="bg-gray-50 border-y border-gray-100 overflow-hidden">
    <div class="container-custom py-4 md:py-6">
        <!-- Promo Banner Slider / Marquee -->
        <div class="relative overflow-hidden">
            <div class="flex animate-marquee whitespace-nowrap" id="promoMarquee">
                @foreach($promos as $promo)
                    <div class="flex items-center gap-6 mx-8 text-sm md:text-base font-medium text-gray-700">
                        @if($promo['icon'] ?? false)
                            <span class="text-primary text-xl">{{ $promo['icon'] }}</span>
                        @endif
                        <span>{{ $promo['text'] ?? '' }}</span>
                        @if($promo['link'] ?? false)
                            <a href="{{ $promo['link'] }}" class="text-primary hover:underline font-bold text-xs md:text-sm">
                                {{ $promo['link_text'] ?? 'Lihat Detail' }} →
                            </a>
                        @endif
                    </div>
                @endforeach
                <!-- Duplikat untuk efek infinite scroll -->
                @foreach($promos as $promo)
                    <div class="flex items-center gap-6 mx-8 text-sm md:text-base font-medium text-gray-700">
                        @if($promo['icon'] ?? false)
                            <span class="text-primary text-xl">{{ $promo['icon'] }}</span>
                        @endif
                        <span>{{ $promo['text'] ?? '' }}</span>
                        @if($promo['link'] ?? false)
                            <a href="{{ $promo['link'] }}" class="text-primary hover:underline font-bold text-xs md:text-sm">
                                {{ $promo['link_text'] ?? 'Lihat Detail' }} →
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 25s linear infinite;
        width: max-content;
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>