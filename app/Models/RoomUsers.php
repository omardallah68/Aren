<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomUsers extends Model
{
    use HasFactory;

    public function user() {
        return $this->hasMany(User::class, 'user_id');
    }

    public function chatRoom() {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }
}
