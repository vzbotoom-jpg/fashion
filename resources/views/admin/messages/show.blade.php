@extends('layouts.admin')

@section('title', 'Detail Pesan - Admin Panel')
@section('page_title', 'Detail Pesan')
@section('page_subtitle', 'Dari: ' . $message->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Message Content -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $message->subject }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Dari: {{ $message->name }} ({{ $message->email }})
                        @if($message->phone)
                            <span class="ml-2">📞 {{ $message->phone }}</span>
                        @endif
                    </p>
                </div>
                <span class="badge {{ $message->status === 'unread' ? 'badge-danger' : ($message->status === 'replied' ? 'badge-success' : 'badge-warning') }}">
                    {{ $message->status_label }}
                </span>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
            </div>

            <div class="mt-4 text-sm text-gray-400">
                Dikirim: {{ $message->created_at->format('d M Y H:i:s') }}
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h4 class="font-semibold text-gray-800 mb-4">⚙️ Aksi</h4>
            <div class="space-y-3">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" 
                   class="block w-full btn-primary py-2 rounded-lg text-center">
                    📧 Balas via Email
                </a>
                
                <form action="{{ route('admin.messages.mark-replied', $message->id) }}" method="POST" class="inline w-full">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="w-full btn-secondary py-2 rounded-lg">
                        ✅ Tandai Sudah Dibalas
                    </button>
                </form>

                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline w-full" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition">
                        🗑️ Hapus Pesan
                    </button>
                </form>
            </div>
        </div>

        <a href="{{ route('admin.messages.index') }}" class="block text-center btn-secondary py-3 rounded-lg">
            ← Kembali ke Daftar
        </a>
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