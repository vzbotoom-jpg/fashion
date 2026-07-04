<!-- Admin Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="container mx-auto px-6 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between text-sm">
            <div class="text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'Fashion Pre-Order') }}. All rights reserved.
            </div>
            <div class="flex items-center space-x-4 mt-2 md:mt-0">
                <span class="text-gray-400">|</span>
                <span class="text-gray-500">
                    Version <span class="font-medium text-gray-700">1.0.0</span>
                </span>
                <span class="text-gray-400">|</span>
                <span class="text-gray-500">
                    PHP {{ phpversion() }}
                </span>
                <span class="text-gray-400">|</span>
                <span class="text-gray-500">
                    Laravel {{ app()->version() }}
                </span>
            </div>
        </div>
    </div>
</footer>