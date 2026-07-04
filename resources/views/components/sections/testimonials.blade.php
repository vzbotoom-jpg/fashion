@props([
    'testimonials' => [],
    'title' => 'Testimoni Pelanggan',
    'subtitle' => 'Apa kata pelanggan tentang kami',
])

<section class="section-padding">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white">{{ $title }}</h2>
            <p class="text-gray-400 mt-2">{{ $subtitle }}</p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-card">
                    <!-- Rating -->
                    <div class="testimonial-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $testimonial->rating)
                                <svg class="testimonial-star testimonial-star-filled" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @else
                                <svg class="testimonial-star testimonial-star-empty fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    
                    <!-- Content -->
                    <p class="testimonial-content">
                        "{{ $testimonial->content }}"
                    </p>
                    
                    <!-- Customer Info -->
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            {{ strtoupper(substr($testimonial->customer_name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="testimonial-name">{{ $testimonial->customer_name }}</p>
                            <p class="testimonial-date">{{ $testimonial->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Chat Bubble Icon -->
                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada testimoni</p>
                </div>
            @endforelse
        </div>
    </div>
</section>