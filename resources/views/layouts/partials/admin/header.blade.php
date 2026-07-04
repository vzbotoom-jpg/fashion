<!-- Admin Header -->
<header class="bg-white border-b border-gray-200 sticky top-0 z-40">
    <div class="flex items-center justify-between px-6 py-3">
        <!-- Left Side - Page Title -->
        <div class="flex items-center space-x-4">
            <button id="sidebar-toggle" class="lg:hidden text-gray-500 hover:text-gray-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h1 class="text-xl font-semibold text-gray-800">@yield('page_title', 'Dashboard')</h1>
                <p class="text-sm text-gray-500">@yield('page_subtitle', 'Welcome to admin panel')</p>
            </div>
        </div>
        
        <!-- Right Side -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="hidden md:block relative">
                <input type="text" 
                       placeholder="Search..." 
                       class="pl-9 pr-4 py-2 bg-gray-100 border border-transparent rounded-lg text-sm focus:outline-none focus:border-primary focus:bg-white transition w-48 lg:w-64">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @php
                        $notificationCount = \App\Models\ContactMessage::where('status', 'unread')->count() + 
                                             \App\Models\PreOrder::where('status', 'pending')->count() +
                                             \App\Models\CustomOrder::where('status', 'pending')->count();
                    @endphp
                    @if($notificationCount > 0)
                        <span class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $notificationCount > 9 ? '9+' : $notificationCount }}
                        </span>
                    @endif
                </button>
                
                <!-- Dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden z-50">
                    <div class="p-3 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                    </div>
                    <div class="max-h-80 overflow-y-auto">
                        @php
                            $unreadMessages = \App\Models\ContactMessage::where('status', 'unread')->limit(5)->get();
                            $pendingPreOrders = \App\Models\PreOrder::where('status', 'pending')->limit(5)->get();
                            $pendingCustomOrders = \App\Models\CustomOrder::where('status', 'pending')->limit(5)->get();
                        @endphp
                        
                        @if($unreadMessages->isNotEmpty())
                            @foreach($unreadMessages as $message)
                                <a href="{{ route('admin.messages.show', $message->id) }}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-lg">✉️</span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 truncate">{{ $message->subject }}</p>
                                            <p class="text-xs text-gray-500">Dari: {{ $message->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="w-2 h-2 bg-red-500 rounded-full flex-shrink-0 mt-1.5"></span>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                        @if($pendingPreOrders->isNotEmpty())
                            @foreach($pendingPreOrders as $preOrder)
                                <a href="{{ route('admin.pre-orders.show', $preOrder->id) }}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-lg">📦</span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 truncate">Pre-Order #{{ $preOrder->order_number }}</p>
                                            <p class="text-xs text-gray-500">Dari: {{ $preOrder->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $preOrder->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full flex-shrink-0 mt-1.5"></span>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                        @if($pendingCustomOrders->isNotEmpty())
                            @foreach($pendingCustomOrders as $customOrder)
                                <a href="{{ route('admin.custom-orders.show', $customOrder->id) }}" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0">
                                    <div class="flex items-start space-x-3">
                                        <span class="text-lg">🎨</span>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 truncate">Custom Order #{{ $customOrder->order_number }}</p>
                                            <p class="text-xs text-gray-500">Dari: {{ $customOrder->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $customOrder->created_at->diffForHumans() }}</p>
                                        </div>
                                        <span class="w-2 h-2 bg-purple-500 rounded-full flex-shrink-0 mt-1.5"></span>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                        
                        @if($unreadMessages->isEmpty() && $pendingPreOrders->isEmpty() && $pendingCustomOrders->isEmpty())
                            <div class="text-center py-8">
                                <span class="text-4xl mb-2 block">✅</span>
                                <p class="text-gray-500">Tidak ada notifikasi</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-3 border-t border-gray-200 bg-gray-50">
                        <a href="#" class="text-sm text-primary hover:underline">Lihat semua notifikasi</a>
                    </div>
                </div>
            </div>
            
            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-sm font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 py-1 z-50">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Dashboard
                    </a>
                    <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" target="_blank">
                        Lihat Website
                    </a>
                    <hr class="my-1">
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            🚪 Logout
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
        const sidebar = document.querySelector('aside');
        sidebar.classList.toggle('-translate-x-full');
    });
</script>