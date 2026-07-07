<!-- Admin Header -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-40 h-16 flex items-center">
    <div class="flex items-center justify-between px-6 w-full">
        <!-- Left Side - Page Title -->
        <div class="flex items-center space-x-4">
            <button id="sidebar-toggle" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="hidden sm:block">
                <h1 class="text-sm font-bold text-gray-900 uppercase tracking-widest">@yield('page_title', 'Dashboard')</h1>
                <p class="text-[10px] font-medium text-gray-400">@yield('page_subtitle', 'Selamat datang kembali')</p>
            </div>
        </div>
        
        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="hidden md:block relative">
                <input type="text" 
                       placeholder="Cari data..."
                       class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary focus:bg-white transition-all w-48 lg:w-64">
                <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2.5 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @php
                        $notificationCount = \App\Models\ContactMessage::where('status', 'unread')->count() + 
                                             \App\Models\PreOrder::where('status', 'pending')->count() +
                                             \App\Models\CustomOrder::where('status', 'pending')->count();
                    @endphp
                    @if($notificationCount > 0)
                        <span class="absolute top-1.5 right-1.5 bg-[#008060] text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center ring-2 ring-white">
                            {{ $notificationCount > 9 ? '9+' : $notificationCount }}
                        </span>
                    @endif
                </button>
                
                <!-- Dropdown -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     @click.away="open = false"
                     class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">
                    <div class="p-4 border-b border-gray-50 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 text-sm">Pusat Notifikasi</h3>
                        <span class="text-[10px] font-bold text-[#008060] bg-teal-50 px-2 py-0.5 rounded-full">{{ $notificationCount }} Baru</span>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        @php
                            $unreadMessages = \App\Models\ContactMessage::where('status', 'unread')->limit(3)->get();
                            $pendingPreOrders = \App\Models\PreOrder::where('status', 'pending')->limit(3)->get();
                            $pendingCustomOrders = \App\Models\CustomOrder::where('status', 'pending')->limit(3)->get();
                        @endphp
                        
                        @if($unreadMessages->isNotEmpty())
                            @foreach($unreadMessages as $message)
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-gray-900 truncate">{{ $message->subject }}</p>
                                            <p class="text-[10px] text-gray-500">Pesan dari {{ $message->name }}</p>
                                            <p class="text-[9px] text-gray-400 mt-1 font-medium">{{ $message->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                        @if($pendingPreOrders->isNotEmpty())
                            @foreach($pendingPreOrders as $preOrder)
                                <a href="{{ route('admin.pre-orders.show', $preOrder->id) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-0">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-8 h-8 bg-yellow-50 text-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-bold text-gray-900 truncate">Pre-Order #{{ $preOrder->order_number }}</p>
                                            <p class="text-[10px] text-gray-500">Menunggu konfirmasi</p>
                                            <p class="text-[9px] text-gray-400 mt-1 font-medium">{{ $preOrder->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                        @if($unreadMessages->isEmpty() && $pendingPreOrders->isEmpty() && $pendingCustomOrders->isEmpty())
                            <div class="text-center py-12">
                                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-400 font-bold">Semua beres!</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-3 bg-gray-50 text-center">
                        <a href="{{ route('admin.messages.index') }}" class="text-[10px] font-bold text-[#008060] uppercase tracking-widest hover:underline">Lihat semua notifikasi</a>
                    </div>
                </div>
            </div>
            
            <div class="w-px h-6 bg-gray-100 mx-1"></div>

            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 p-1 rounded-xl hover:bg-gray-50 transition-all focus:outline-none group">
                    <div class="w-9 h-9 rounded-xl bg-[#008060] text-white flex items-center justify-center text-sm font-bold shadow-lg group-hover:scale-105 transition-transform duration-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-xs font-bold text-gray-900 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">{{ auth()->user()->role }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     @click.away="open = false"
                     class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50 overflow-hidden">
                    <div class="px-4 py-3 border-b border-gray-50 mb-1">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Akun Admin</p>
                    </div>
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-2.5 text-xs font-bold text-gray-700 hover:bg-gray-50 transition-colors" target="_blank">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9-9c1.657 0 3 4.03 3 9s-1.343 9-3 9m0-18c-1.657 0-3 4.03-3 9s1.343 9 3 9m-9-9a9 9 0 019-9"/>
                        </svg>
                        <span>Lihat Website</span>
                    </a>
                    <hr class="my-1 border-gray-50">
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Keluar Panel</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Sidebar toggle for mobile
    document.getElementById('sidebar-toggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('admin-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>