<!-- Admin Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="container mx-auto px-6 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-sm">
            <!-- Copyright -->
            <div class="text-gray-500 text-xs md:text-sm">
                &copy; {{ date('Y') }}
                <span class="font-semibold text-gray-700">{{ config('app.name', 'Fashion') }}</span>
                <span class="hidden sm:inline">- All rights reserved.</span>
            </div>

            <!-- Info -->
            <div class="flex items-center flex-wrap justify-center gap-2 md:gap-4 text-xs md:text-sm">
                <span class="text-gray-400 hidden sm:inline">|</span>
                <span class="text-gray-500">
                    <span class="font-medium text-gray-700">v{{ config('app.version', '1.0.0') }}</span>
                </span>
                <span class="text-gray-400 hidden sm:inline">|</span>
                <span class="text-gray-500">
                    PHP <span class="font-medium text-gray-700">{{ phpversion() }}</span>
                </span>
                <span class="text-gray-400 hidden sm:inline">|</span>
                <span class="text-gray-500">
                    Laravel <span class="font-medium text-gray-700">{{ app()->version() }}</span>
                </span>
                <span class="text-gray-400 hidden sm:inline">|</span>
                <span class="text-gray-500">
                    <span class="inline-flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                        <span class="text-gray-400">Online</span>
                    </span>
                </span>
            </div>
        </div>
    </div>
</footer>