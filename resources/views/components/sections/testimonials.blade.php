@props([
    'testimonials' => [],
    'title' => 'Testimoni Pelanggan',
    'subtitle' => 'Apa kata mereka tentang pengalaman berbelanja di ' . config('app.name'),
])

<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-16">
            <span class="eyebrow">Testimonials</span>
            <h2 class="section-title">{{ $title }}</h2>
            <p class="section-subtitle">{{ $subtitle }}</p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="testimonial-card">
                    <!-- Rating -->
                    <div class="testimonial-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= ($testimonial->rating ?? 5))
                                <svg class="testimonial-star fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @else
                                <svg class="testimonial-star text-gray-200 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    
                    <!-- Content -->
                    <p class="testimonial-content">
                        "{{ $testimonial->content ?? 'Kualitas produk sangat memuaskan dan ukurannya pas sekali. Proses pre-order juga sangat mudah dan transparan.' }}"
                    </p>
                    
                    <!-- Customer Info -->
                    <div class="testimonial-author">
                        <div class="testimonial-avatar">
                            {{ strtoupper(substr($testimonial->customer_name ?? 'P', 0, 1)) }}
                        </div>
                        <div>
                            <p class="testimonial-name">{{ $testimonial->customer_name ?? 'Pelanggan Setia' }}</p>
                            <p class="testimonial-date">{{ isset($testimonial->created_at) ? $testimonial->created_at->format('d M Y') : 'Baru-baru ini' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Static Fallback for Demo -->
                @for($i = 0; $i < 3; $i++)
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        @for($j = 0; $j < 5; $j++)
                        <svg class="testimonial-star fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="testimonial-content">
                        "Saya sangat menyukai konsep pre-order di sini. Kita bisa pesan dengan ukuran sendiri dan hasilnya benar-benar sesuai dengan ekspektasi saya. Pelayanannya sangat ramah!"
                    </p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar bg-gray-100">{{ ['A', 'B', 'S'][$i] }}</div>
                        <div>
                            <p class="testimonial-name">{{ ['Andi Wijaya', 'Budi Santoso', 'Siska Amelia'][$i] }}</p>
                            <p class="testimonial-date">15 Oct 2023</p>
                        </div>
                    </div>
                </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>