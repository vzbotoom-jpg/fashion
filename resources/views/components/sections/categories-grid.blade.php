@props([
    'categories' => [],
    'title' => 'Kategori Produk',
    'subtitle' => 'Pilih kategori yang Anda minati',
])

<section class="section-padding">
    <div class="container-custom">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-display font-bold text-white">{{ $title }}</h2>
            <p class="text-gray-400 mt-2">{{ $subtitle }}</p>
        </div>
        
        <!-- Categories Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="group">
                    <div class="bg-surface-raised border border-white/10 rounded-2xl p-6 text-center hover:bg-white hover:text-gray-950 transition-all duration-300">
                        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">
                            @switch($category->name)
                                @case('Kaos')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    @break
                                @case('Kemeja')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    @break
                                @case('Jaket')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    @break
                                @case('Celana')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    @break
                                @case('Rok')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    @break
                                @case('Gaun')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    @break
                                @case('Aksesoris')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v1m0 0V11"/>
                                    </svg>
                                    @break
                                @case('Sepatu')
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-12 h-12 mx-auto text-gray-300 group-hover:text-gray-950 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                    </svg>
                            @endswitch
                        </div>
                        <h3 class="font-medium text-white group-hover:text-gray-950 transition">
                            {{ $category->name }}
                        </h3>
                        <p class="text-sm text-gray-500 group-hover:text-gray-950/70 transition">
                            {{ $category->products_count ?? 0 }} produk
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <!-- Folder Icon -->
                    <svg class="w-20 h-20 text-gray-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    <p class="text-gray-500">Belum ada kategori</p>
                </div>
            @endforelse
        </div>
    </div>
</section>