<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'user_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'unread' => 'Belum Dibaca',
            'read' => 'Sudah Dibaca',
            'replied' => 'Sudah Dibalas',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusBadgeAttribute(): string
    {
        $colors = [
            'unread' => 'danger',
            'read' => 'warning',
            'replied' => 'success',
        ];
        return $colors[$this->status] ?? 'secondary';
    }

    public function isUnread(): bool
    {
        return $this->status === 'unread';
    }

    public function markAsRead()
    {
        if ($this->isUnread()) {
            $this->update(['status' => 'read']);
        }
    }

    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }
}