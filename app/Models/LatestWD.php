<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class LatestWD extends Model
{
    use HasFactory,UsesUUID;

    protected $table = 'latest_wds';

    protected $fillable = [
        'id',
        'branch_id',
        'code',
        'firm_name',
        'section_name',
        'town',
        'district',
        'status',
    ];

    public function latestCodes()
    {
        return $this->hasMany(LatestCode::class, 'latest_wd_id');
    }
}
