<?php

namespace App\Models;

use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory, UsesUUID;

    protected $fillable = [
        'user_id', 'ip_address', 'browser'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
