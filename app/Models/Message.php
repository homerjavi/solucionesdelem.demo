<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [ 'chat_id', 'user_id', 'content', 'type', 'file_name' ];

    public function user() {
        return $this->belongsTo( User::class );
    }
}
