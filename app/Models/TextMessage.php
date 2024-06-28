<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TextMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'response',
        'sent_to',
        'sent_by',
        'status'
    ];

    public function sentTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_to');
    }

    public function sentBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
