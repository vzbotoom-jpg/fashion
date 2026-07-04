@props([
    'testimonials' => [],
    'title' => 'Apa Kata Mereka?',
    'subtitle' => 'Kepuasan pelanggan adalah prioritas utama kami dalam setiap karya yang kami buat.',
])

<section class="section-padding bg-white">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
            <span class="eyebrow">Testimoni</span>
            <h2 class="section-title">{{ $title }}</h2>
            <p class="section-subtitle">{{ $subtitle }}</p>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testimonial)
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 relative group hover:bg-white hover:shadow-xl transition-all duration-300">
                    <!-- Quote Icon -->
                    <div class="absolute top-6 right-8 text-secondary/10 group-hover:text-secondary/20 transition-colors">
                        <svg class="w-12 h-12 fill-current" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                        </svg>
                    </div>

                    <!-- Rating -->
                    <div class="flex items-center gap-1 mb-6">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= ($testimonial->rating ?? 5) ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    
                    <!-- Content -->
                    <p class="text-gray-700 leading-relaxed mb-8 italic relative z-10">
                        "{{ $testimonial->content }}"
                    </p>
                    
                    <!-- Customer Info -->
                    <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
                        <div class="w-12 h-12 rounded-full bg-secondary/10 text-secondary flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                            {{ strtoupper(substr($testimonial->customer_name ?? 'A', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $testimonial->customer_name ?? 'Pelanggan Setia' }}</p>
                            <p class="text-sm text-gray-500">{{ isset($testimonial->created_at) ? (is_string($testimonial->created_at) ? $testimonial->created_at : $testimonial->created_at->format('d M Y')) : 'Baru saja' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Demo Testimonials if empty -->
                @php
                    $demos = [
                        ['name' => 'Siti Rahma', 'content' => 'Kualitas kainnya luar biasa, ukurannya sangat pas di badan saya. Pengalaman custom order yang sangat memuaskan!', 'rating' => 5],
                        ['name' => 'Budi Santoso', 'content' => 'Proses pengerjaan cepat dan hasilnya melebihi ekspektasi. Sangat direkomendasikan untuk yang cari baju custom.', 'rating' => 5],
                        ['name' => 'Linda Wijaya', 'content' => 'Customer servicenya sangat ramah dan membantu saat saya bingung memilih ukuran. Terima kasih Fashion Pre-Order!', 'rating' => 4],
                    ];
                @endphp
                @foreach($demos as $demo)
                    <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 relative group hover:bg-white hover:shadow-xl transition-all duration-300">
                        <div class="absolute top-6 right-8 text-secondary/10 group-hover:text-secondary/20 transition-colors">
                            <svg class="w-12 h-12 fill-current" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <div class="flex items-center gap-1 mb-6">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $demo['rating'] ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-8 italic relative z-10">"{{ $demo['content'] }}"</p>
                        <div class="flex items-center gap-4 border-t border-gray-100 pt-6">
                            <div class="w-12 h-12 rounded-full bg-secondary/10 text-secondary flex items-center justify-center font-bold text-lg border-2 border-white shadow-sm">
                                {{ substr($demo['name'], 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $demo['name'] }}</p>
                                <p class="text-sm text-gray-500">Pelanggan Terverifikasi</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforelse
        </div>
    </div>
</section>
