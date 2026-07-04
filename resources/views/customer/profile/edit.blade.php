@extends('layouts.app')

@section('title', 'Profil Saya - ' . config('app.name'))

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold mx-auto mb-4">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <h1 class="text-3xl font-display font-bold text-gray-800">Profil Saya</h1>
                    <p class="text-gray-500 mt-1">Update informasi profil Anda</p>
                </div>

                <!-- Profile Form -->
                <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-form.input 
                            name="name" 
                            label="Nama Lengkap" 
                            value="{{ auth()->user()->name }}"
                            required
                        />
                        <x-form.input 
                            type="email"
                            name="email" 
                            label="Email" 
                            value="{{ auth()->user()->email }}"
                            required
                            disabled
                        />
                        <x-form.input 
                            name="phone" 
                            label="Nomor Telepon" 
                            value="{{ auth()->user()->phone }}"
                        />
                        <x-form.input 
                            name="city" 
                            label="Kota" 
                            value="{{ auth()->user()->city }}"
                        />
                        <x-form.input 
                            name="province" 
                            label="Provinsi" 
                            value="{{ auth()->user()->province }}"
                        />
                        <x-form.input 
                            name="postal_code" 
                            label="Kode Pos" 
                            value="{{ auth()->user()->postal_code }}"
                        />
                    </div>

                    <x-form.textarea 
                        name="address" 
                        label="Alamat" 
                        value="{{ auth()->user()->address }}"
                        rows="3"
                    />

                    <hr class="border-gray-200">

                    <!-- Change Password -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <!-- Lock Icon -->
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Ubah Password
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-form.input 
                                type="password"
                                name="current_password" 
                                label="Password Saat Ini" 
                                placeholder="Masukkan password lama"
                            />
                            <x-form.input 
                                type="password"
                                name="new_password" 
                                label="Password Baru" 
                                placeholder="Minimal 8 karakter"
                            />
                            <x-form.input 
                                type="password"
                                name="new_password_confirmation" 
                                label="Konfirmasi Password Baru" 
                                placeholder="Ulangi password baru"
                            />
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="btn-primary px-8 py-3 rounded-lg flex items-center justify-center gap-2">
                            <!-- Save Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('home') }}" class="btn-secondary px-8 py-3 rounded-lg text-center flex items-center justify-center gap-2">
                            <!-- Arrow Left Icon -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection