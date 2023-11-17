<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_do_id',
        'user_id',
        'chat_details',
    ];
}
