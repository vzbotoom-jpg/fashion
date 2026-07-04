@extends('layouts.app')

@section('title', 'Profil Saya - ' . config('app.name'))

@section('content')
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-12">
                <span class="eyebrow">Informasi Akun</span>
                <h1 class="section-title">Profil Saya</h1>
                <p class="section-subtitle">Kelola informasi pribadi dan pengaturan keamanan akun Anda.</p>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-12 border-b border-gray-50 pb-12">
                        <div class="w-24 h-24 rounded-full bg-secondary/10 text-secondary flex items-center justify-center text-4xl font-bold border border-secondary/20">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="text-center md:text-left space-y-2">
                            <h2 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-500">{{ auth()->user()->email }}</p>
                            <span class="badge badge-success">Pelanggan Aktif</span>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-12">
                        @csrf
                        @method('PUT')

                        <!-- Personal Info -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-50 text-gray-400 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                Informasi Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                                           class="form-input" placeholder="Nama lengkap Anda">
                                </div>
                                <div>
                                    <label class="form-label">Email</label>
                                    <input type="email" value="{{ auth()->user()->email }}" disabled
                                           class="form-input !bg-gray-50 !text-gray-500 cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                           class="form-input" placeholder="Contoh: 081234567890">
                                </div>
                            </div>
                        </div>

                        <!-- Address Info -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-50 text-gray-400 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                </div>
                                Alamat Default
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="address" rows="3" class="form-input" placeholder="Masukkan alamat lengkap">{{ old('address', auth()->user()->address) }}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}"
                                           class="form-input" placeholder="Kota">
                                </div>
                                <div>
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" name="province" value="{{ old('province', auth()->user()->province) }}"
                                           class="form-input" placeholder="Provinsi">
                                </div>
                                <div>
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', auth()->user()->postal_code) }}"
                                           class="form-input" placeholder="Kode Pos">
                                </div>
                            </div>
                        </div>

                        <!-- Security -->
                        <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                                <div class="w-8 h-8 bg-white text-gray-400 rounded-lg flex items-center justify-center shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                Keamanan & Password
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="form-label">Password Saat Ini</label>
                                    <input type="password" name="current_password" class="form-input" placeholder="Wajib diisi jika ingin mengubah password">
                                </div>
                                <div>
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="new_password" class="form-input" placeholder="Minimal 8 karakter">
                                </div>
                                <div>
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" class="form-input" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-50">
                            <button type="submit" class="btn-primary !px-10 !py-4 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('home') }}" class="btn-secondary !px-10 !py-4 flex items-center justify-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
