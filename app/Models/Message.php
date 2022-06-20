<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['from','to', 'message', 'creator_id'];

    

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
