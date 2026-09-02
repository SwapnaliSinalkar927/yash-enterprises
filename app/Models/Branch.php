<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class Branch extends Model
{
    use UsesUUID;

    protected $fillable = [
        'name',
        'short_code',
        'status'
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function latestCodes()
    {
        return $this->hasMany(LatestCode::class);
    }
}
