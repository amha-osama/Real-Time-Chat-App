<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    //
    protected $fillable = [
        'created_at',
        'updated_at',
        'message',
        'is_read',
        'conversation_id',
        'sender_id',
        'receiver_id',
    
    ];


    public function conversation():BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}
