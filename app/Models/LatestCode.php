<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class LatestCode extends Model
{
    use UsesUUID;

    protected $fillable = [
        'id',
        'code',
        'value',
        'latest_wd_id',
        'brand_id',
        'branch_id',
        'is_used',
        'batch',
        'denomination',
        'status',
        'used_at',
    ];

    public function latestWd()
    {
        return $this->belongsTo(LatestWD::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function latestOrders() {
        return $this->hasMany(LatestOrder::class);
    }
}
