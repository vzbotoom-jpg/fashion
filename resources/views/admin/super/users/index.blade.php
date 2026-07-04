@extends('layouts.admin')

@section('title', 'Manajemen User - Super Admin')
@section('page_title', 'Manajemen User')
@section('page_subtitle', 'Kelola semua user di sistem')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $users->total() }} user</p>
    <a href="{{ route('admin.super.users.create') }}" class="btn-primary px-4 py-2 rounded-lg text-sm">
        + Tambah User
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form action="{{ route('admin.super.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
        <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
            <option value="">Semua Role</option>
            @foreach($roles ?? [] as $value => $label)
                <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg">🔍 Filter</button>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-medium text-gray-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $user->role === 'super_admin' ? 'badge-primary' : ($user->role === 'admin' ? 'badge-warning' : 'badge-default') }}">
                                {{ $user->role_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $user->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.super.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                                    ✏️
                                </a>
                                <a href="{{ route('admin.super.users.toggle', $user->id) }}" class="text-yellow-500 hover:text-yellow-700" onclick="return confirm('Ubah status user ini?')">
                                    🔄
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.super.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">🗑️</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <span class="text-4xl block mb-2">👤</span>
                            Belum ada user
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $users->links() }}
    </div>
</div>

<style>
    .badge {
        @apply px-2 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
    .badge-primary {
        @apply bg-primary/20 text-primary;
    }
    .badge-warning {
        @apply bg-yellow-100 text-yellow-800;
    }
    .badge-default {
        @apply bg-gray-100 text-gray-800;
    }
</style>
@endsection