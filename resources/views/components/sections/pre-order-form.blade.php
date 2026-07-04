@props([
    'product' => null,
    'sizes' => [],
])

<form action="{{ route('customer.pre-order.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <input type="hidden" name="product_id" value="{{ $product ? $product->id : '' }}">
    
    <!-- Size Selection -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Ukuran <span class="text-red-500">*</span></label>
        <select name="size_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
            <option value="">Pilih Ukuran</option>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }} ({{ $size->code }})</option>
            @endforeach
        </select>
    </div>
    
    <!-- Quantity -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
        <input type="number" name="quantity" min="1" max="10" value="1" required 
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
    </div>
    
    <!-- Shipping Address -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman <span class="text-red-500">*</span></label>
        <textarea name="shipping_address" rows="3" required 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                  placeholder="Masukkan alamat lengkap dengan kode pos">{{ auth()->user()->address ?? '' }}</textarea>
    </div>
    
    <!-- Phone -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
        <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
    </div>
    
    <!-- Notes -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
        <textarea name="notes" rows="2" 
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                  placeholder="Tambahkan catatan jika ada"></textarea>
    </div>
    
    <!-- Submit -->
    <button type="submit" class="w-full btn-primary py-4 text-lg rounded-xl flex items-center justify-center gap-2">
        <!-- Package Icon -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
        Buat Pre-Order
    </button>
</form>