<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'message'];

    public function getMessagesFromGuide()
    {
        $messages = Message::whereHas('sender_id', function ($query) {
            $query->where('role', 'guide');
        })->get();

        return $messages;
    }
}
