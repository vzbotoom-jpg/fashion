<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,super_admin']);
    }

    public function index(Request $request)
    {
        $query = ContactMessage::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(15);
        $statuses = ['unread', 'read', 'replied'];

        return view('admin.messages.index', compact('messages', 'statuses'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markAsReplied($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'replied']);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan ditandai sebagai sudah dibalas!');
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}