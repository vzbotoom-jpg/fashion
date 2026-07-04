@props([
    'product' => null,
    'sizes' => [],
])

<form action="{{ route('customer.custom-order.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    
    <input type="hidden" name="product_id" value="{{ $product ? $product->id : '' }}">
    
    <!-- Size Selection -->
    <div>
        <label class="form-label">Pilih Ukuran <span class="text-red-400">*</span></label>
        <select name="size_id" required class="form-input">
            <option value="">Pilih Ukuran</option>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }} ({{ $size->code }})</option>
            @endforeach
        </select>
    </div>
    
    <!-- Quantity -->
    <div>
        <label class="form-label">Jumlah <span class="text-red-400">*</span></label>
        <input type="number" name="quantity" min="1" max="10" value="1" required 
               class="form-input">
    </div>
    
    <!-- Custom Description -->
    <div>
        <label class="form-label">Deskripsi Custom Order <span class="text-red-400">*</span></label>
        <textarea name="custom_description" rows="4" required 
                  class="form-input"
                  placeholder="Jelaskan detail custom order yang Anda inginkan (warna, model, bahan, dll)"></textarea>
    </div>
    
    <!-- Custom Image -->
    <div>
        <label class="form-label">Gambar Referensi (Opsional)</label>
        <div class="border-2 border-dashed border-white/15 rounded-xl p-6 text-center hover:border-white/40 transition">
            <input type="file" name="custom_image" accept="image/*" 
                   class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-white file:text-gray-950 hover:file:bg-gray-100">
            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG (Max 2MB)</p>
        </div>
    </div>
    
    <!-- Shipping Address -->
    <div>
        <label class="form-label">Alamat Pengiriman <span class="text-red-400">*</span></label>
        <textarea name="shipping_address" rows="3" required 
                  class="form-input"
                  placeholder="Masukkan alamat lengkap dengan kode pos">{{ auth()->user()->address ?? '' }}</textarea>
    </div>
    
    <!-- Phone -->
    <div>
        <label class="form-label">Nomor Telepon <span class="text-red-400">*</span></label>
        <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" required
               class="form-input">
    </div>
    
    <!-- Notes -->
    <div>
        <label class="form-label">Catatan (Opsional)</label>
        <textarea name="notes" rows="2" 
                  class="form-input"
                  placeholder="Tambahkan catatan jika ada"></textarea>
    </div>
    
    <!-- Submit -->
    <button type="submit" class="w-full btn-primary btn-lg flex items-center justify-center gap-2">
        <!-- Paint Brush Icon -->
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
        </svg>
        Buat Custom Order
    </button>
</form>