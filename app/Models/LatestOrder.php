<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class LatestOrder extends Model
{
    use HasFactory,UsesUUID;

    protected $fillable = [
        'id',
        'latest_wholesaler_id',
        'latest_code_id',
        'brand_id',
        'value',
    ];

    public function latestWholesaler()
    {
        return $this->belongsTo(LatestWholesaler::class);
    }

    public function latestCode()
    {
        return $this->belongsTo(LatestCode::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
