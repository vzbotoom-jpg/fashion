@extends('layouts.admin')

@section('title', 'Manajemen Pesan - Admin Panel')
@section('page_title', 'Pesan Kontak')
@section('page_subtitle', 'Kelola semua pesan dari pelanggan')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">Total: {{ $messages->total() }} pesan</p>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6">
    <form action="{{ route('admin.messages.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
            <option value="">Semua Status</option>
            @foreach($statuses ?? [] as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition">
        <button type="submit" class="btn-primary px-4 py-2 rounded-lg">🔍 Filter</button>
    </form>
</div>

<!-- Messages Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subjek</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($messages as $message)
                    <tr class="hover:bg-gray-50 transition {{ $message->status === 'unread' ? 'bg-blue-50' : '' }}">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">{{ $message->name }}</p>
                                <p class="text-xs text-gray-500">{{ $message->email }}</p>
                                @if($message->phone)
                                    <p class="text-xs text-gray-400">{{ $message->phone }}</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                            <p class="font-medium">{{ $message->subject }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ Str::limit($message->message, 50) }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $message->status === 'unread' ? 'badge-danger' : ($message->status === 'replied' ? 'badge-success' : 'badge-warning') }}">
                                {{ $message->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $message->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="text-primary hover:underline text-sm">
                                Detail →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <span class="text-4xl block mb-2">✉️</span>
                            Belum ada pesan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $messages->links() }}
    </div>
</div>

<style>
    .badge {
        @apply px-2 py-0.5 rounded-full text-xs font-medium;
    }
    .badge-danger {
        @apply bg-red-100 text-red-800;
    }
    .badge-warning {
        @apply bg-yellow-100 text-yellow-800;
    }
    .badge-success {
        @apply bg-green-100 text-green-800;
    }
</style>
@endsection