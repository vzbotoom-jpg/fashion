<!-- Admin Sidebar -->
<aside class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white z-50">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-4 border-b border-gray-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                <span class="text-xl font-display font-bold text-primary-light">
                    {{ config('app.name', 'Fashion') }}
                </span>
                <span class="text-xs bg-primary text-white px-2 py-0.5 rounded">Admin</span>
            </a>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition @if(Route::is('admin.dashboard')) bg-primary text-white @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                <span>Dashboard</span>
            </a>
            
            <!-- Products -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Produk</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Semua Produk
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Tambah Produk
                    </a>
                    <a href="{{ route('admin.products.index') }}?tab=stock" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Manajemen Stok
                    </a>
                </div>
            </div>
            
            <!-- Categories -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span>Kategori</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Semua Kategori
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Tambah Kategori
                    </a>
                </div>
            </div>
            
            <!-- Collections -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span>Koleksi</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.collections.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Semua Koleksi
                    </a>
                    <a href="{{ route('admin.collections.create') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Tambah Koleksi
                    </a>
                </div>
            </div>
            
            <!-- Orders -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span>Pesanan</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Semua Pesanan
                    </a>
                    <a href="{{ route('admin.pre-orders.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Pre-Order
                    </a>
                    <a href="{{ route('admin.custom-orders.index') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Custom Order
                    </a>
                </div>
            </div>
            
            <!-- Gallery -->
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Galeri</span>
            </a>
            
            <!-- Testimonials -->
            <a href="{{ route('admin.testimonials.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Testimoni</span>
            </a>
            
            <!-- Messages -->
            <a href="{{ route('admin.messages.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Pesan</span>
                @php
                    $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>
            
            <!-- Reports -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Laporan</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" class="ml-4 mt-1 space-y-1">
                    <a href="{{ route('admin.reports.orders') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Laporan Pesanan
                    </a>
                    <a href="{{ route('admin.reports.sales') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Laporan Penjualan
                    </a>
                    <a href="{{ route('admin.reports.stock') }}" class="block px-3 py-2 text-sm rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                        Laporan Stok
                    </a>
                </div>
            </div>
            
            <!-- Analytics -->
            <a href="{{ route('admin.analytics') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span>Analitik</span>
            </a>
            
            <!-- SUPER ADMIN ONLY MENU -->
            @if(auth()->user()->role === 'super_admin')
                <div class="pt-4 mt-4 border-t border-gray-800">
                    <p class="px-3 text-xs text-gray-500 uppercase tracking-wider font-semibold">Super Admin</p>
                    
                    <!-- Users -->
                    <a href="{{ route('admin.super.users.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white mt-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Manajemen User</span>
                    </a>
                    
                    <!-- Settings -->
                    <a href="{{ route('admin.super.settings.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition text-gray-300 hover:bg-gray-800 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Pengaturan</span>
                    </a>
                </div>
            @endif
        </nav>
        
        <!-- Footer -->
        <div class="p-4 border-t border-gray-800">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-200 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white transition" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>