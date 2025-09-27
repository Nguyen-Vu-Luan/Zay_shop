<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['from_id', 'to_id', 'message'];

    // Người gửi
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    // Người nhận
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
