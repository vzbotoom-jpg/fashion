<!-- Admin Sidebar -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 w-64 bg-[#1A1A1A] text-white z-50 transition-transform duration-300 lg:translate-x-0 -translate-x-full border-r border-white/5 shadow-2xl">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-6 border-b border-white/5">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                <div class="w-8 h-8 bg-[#008060] rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <div>
                    <span class="text-lg font-bold tracking-tight block leading-none">Fashion</span>
                    <span class="text-[10px] text-[#008060] font-bold uppercase tracking-widest">Admin Panel</span>
                </div>
            </a>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1 custom-scrollbar">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ Route::is('admin.dashboard') ? 'bg-[#008060] text-white' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-sm font-bold">Dashboard</span>
            </a>
            
            <!-- Produk -->
            <div x-data="{ open: {{ str_contains(Route::currentRouteName(), 'admin.products') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.products') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span class="text-sm font-bold">Produk</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition.origin.top class="pl-12 mt-1 space-y-1">
                    <a href="{{ route('admin.products.index') }}" class="block py-2 text-xs font-bold transition-colors {{ Request::is('admin/products') ? 'text-white' : 'text-gray-500 hover:text-white' }}">Semua Produk</a>
                    <a href="{{ route('admin.products.create') }}" class="block py-2 text-xs font-bold transition-colors {{ Route::is('admin.products.create') ? 'text-white' : 'text-gray-500 hover:text-white' }}">Tambah Produk</a>
                </div>
            </div>
            
            <!-- Koleksi -->
            <a href="{{ route('admin.collections.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.collections') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span class="text-sm font-bold">Koleksi</span>
            </a>

            <!-- Kategori -->
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.categories') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span class="text-sm font-bold">Kategori</span>
            </a>
            
            <!-- Pre-Order -->
            <a href="{{ route('admin.pre-orders.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.pre-orders') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-bold">Pre-Order</span>
            </a>

            <!-- Custom Order -->
            <a href="{{ route('admin.custom-orders.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.custom-orders') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                <span class="text-sm font-bold">Custom Order</span>
            </a>
            
            <!-- Galeri -->
            <a href="{{ route('admin.gallery.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.gallery') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm font-bold">Galeri</span>
            </a>
            
            <!-- Testimoni -->
            <a href="{{ route('admin.testimonials.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.testimonials') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span class="text-sm font-bold">Testimoni</span>
            </a>
            
            <!-- Pesan -->
            <a href="{{ route('admin.messages.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.messages') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <div class="relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-[#008060] rounded-full border border-[#1A1A1A]"></span>
                    @endif
                </div>
                <span class="text-sm font-bold">Pesan</span>
            </a>

            <!-- Pembayaran -->
            <a href="{{ route('admin.payments.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.payments') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span class="text-sm font-bold">Pembayaran</span>
            </a>
            
            <!-- Laporan -->
            <div x-data="{ open: {{ str_contains(Route::currentRouteName(), 'admin.reports') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.reports') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="text-sm font-bold">Laporan</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition.origin.top class="pl-12 mt-1 space-y-1">
                    <a href="{{ route('admin.reports.orders') }}" class="block py-2 text-xs font-bold transition-colors {{ Route::is('admin.reports.orders') ? 'text-white' : 'text-gray-500 hover:text-white' }}">Pesanan</a>
                    <a href="{{ route('admin.reports.sales') }}" class="block py-2 text-xs font-bold transition-colors {{ Route::is('admin.reports.sales') ? 'text-white' : 'text-gray-500 hover:text-white' }}">Penjualan</a>
                    <a href="{{ route('admin.reports.stock') }}" class="block py-2 text-xs font-bold transition-colors {{ Route::is('admin.reports.stock') ? 'text-white' : 'text-gray-500 hover:text-white' }}">Stok</a>
                </div>
            </div>
            
            <!-- Analitik -->
            <a href="{{ route('admin.analytics') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ Route::is('admin.analytics') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                <span class="text-sm font-bold">Analitik</span>
            </a>
            
            <!-- SUPER ADMIN ONLY MENU -->
            @if(auth()->user()->role === 'super_admin')
                <div class="pt-6 mt-6 border-t border-white/5">
                    <p class="px-4 text-[10px] text-gray-600 font-bold uppercase tracking-widest mb-4">Master Data</p>
                    
                    <!-- Manajemen User -->
                    <a href="{{ route('admin.super.users.index') }}"
                       class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.super.users') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="text-sm font-bold">Manajemen User</span>
                    </a>
                    
                    <!-- Pengaturan -->
                    <a href="{{ route('admin.super.settings.index') }}"
                       class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ str_contains(Route::currentRouteName(), 'admin.super.settings') ? 'text-[#008060]' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-bold">Pengaturan</span>
                    </a>
                </div>
            @endif
        </nav>
        
        <!-- User Section Footer -->
        <div class="p-6 border-t border-white/5 bg-black/20">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-[#008060] text-white flex items-center justify-center font-bold shadow-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-gray-500 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.1);
    }
</style>