<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    //
    protected $fillable = [
        'id',
        'sender_id',
        'receiver_id',
        'created_at',
        'updated_at',
    ];


    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function user():HasMany
    {
        return $this->hasMany(User::class);
    }
}
