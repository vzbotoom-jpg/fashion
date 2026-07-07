<!-- Admin Header -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-40 h-16 flex items-center shadow-sm">
    <div class="flex items-center justify-between px-4 md:px-6 w-full">
        <!-- Left Side - Page Title -->
        <div class="flex items-center space-x-3">
            <button id="sidebar-toggle" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="hidden sm:block">
                <h1 class="text-sm font-bold text-gray-900 uppercase tracking-wider">@yield('page_title', 'Dashboard')</h1>
                <p class="text-[10px] font-medium text-gray-400">@yield('page_subtitle', 'Selamat datang kembali')</p>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-3 md:space-x-4">
            <!-- Search Bar -->
            <div class="hidden md:block relative">
                <form action="{{ route('admin.search') }}" method="GET" class="relative">
                    <input type="text"
                           name="q"
                           placeholder="Cari data..."
                           class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 focus:bg-white transition-all w-48 lg:w-64">
                    <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </form>
            </div>

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
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
                        <span class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[9px] font-bold rounded-full w-4 h-4 flex items-center justify-center ring-2 ring-white">
                            {{ $notificationCount > 9 ? '9+' : $notificationCount }}
                        </span>
                    @endif
                </button>

                <!-- Dropdown Notifikasi -->
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">

                    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="font-bold text-gray-900 text-sm">Notifikasi</h3>
                        <span class="text-[10px] font-bold text-white bg-primary px-2 py-0.5 rounded-full">{{ $notificationCount }} Baru</span>
                    </div>

                    <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
                        @php
                            $unreadMessages = \App\Models\ContactMessage::where('status', 'unread')->limit(3)->get();
                            $pendingPreOrders = \App\Models\PreOrder::where('status', 'pending')->limit(3)->get();
                            $pendingCustomOrders = \App\Models\CustomOrder::where('status', 'pending')->limit(3)->get();
                        @endphp

                        @forelse($unreadMessages as $message)
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-gray-900 truncate">{{ $message->subject }}</p>
                                        <p class="text-[10px] text-gray-500">Pesan dari {{ $message->name }}</p>
                                        <p class="text-[9px] text-gray-400 mt-0.5">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            @forelse($pendingPreOrders as $preOrder)
                                <a href="{{ route('admin.pre-orders.show', $preOrder->id) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-yellow-50 text-yellow-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-xs font-semibold text-gray-900 truncate">Pre-Order #{{ $preOrder->order_number }}</p>
                                            <p class="text-[10px] text-gray-500">Menunggu konfirmasi</p>
                                            <p class="text-[9px] text-gray-400 mt-0.5">{{ $preOrder->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                @forelse($pendingCustomOrders as $customOrder)
                                    <a href="{{ route('admin.custom-orders.show', $customOrder->id) }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 bg-purple-50 text-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-xs font-semibold text-gray-900 truncate">Custom Order #{{ $customOrder->order_number }}</p>
                                                <p class="text-[10px] text-gray-500">Menunggu konfirmasi</p>
                                                <p class="text-[9px] text-gray-400 mt-0.5">{{ $customOrder->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-8">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <p class="text-xs text-gray-400 font-medium">Tidak ada notifikasi</p>
                                    </div>
                                @endforelse
                            @endforelse
                        @endforelse
                    </div>

                    <div class="p-3 bg-gray-50 text-center border-t border-gray-100">
                        <a href="{{ route('admin.messages.index') }}" class="text-[10px] font-bold text-primary uppercase tracking-wider hover:underline">
                            Lihat semua notifikasi
                        </a>
                    </div>
                </div>
            </div>

            <!-- Separator -->
            <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>

            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center gap-2 p-1 rounded-xl hover:bg-gray-50 transition-all focus:outline-none group">
                    <div class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-primary text-white flex items-center justify-center text-sm font-bold shadow-sm group-hover:scale-105 transition-transform duration-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-xs font-bold text-gray-900 leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] font-medium text-gray-400 uppercase tracking-wider">{{ auth()->user()->role }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 hidden lg:block" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown User -->
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50 overflow-hidden">

                    <div class="px-4 py-3 border-b border-gray-50">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akun Admin</p>
                    </div>

                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 text-xs font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9-9c1.657 0 3 4.03 3 9s-1.343 9-3 9m0-18c-1.657 0-3 4.03-3 9s1.343 9 3 9m-9-9a9 9 0 019-9"/>
                        </svg>
                        Lihat Website
                    </a>

                    <hr class="my-1 border-gray-100">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar Panel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    });
</script>