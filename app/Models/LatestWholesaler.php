<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class LatestWholesaler extends Model
{
    use HasFactory, UsesUUID;

    protected $fillable = [
         'id',
        'full_name',
        'mobile_number',
        'pincode',
        'lat',
        'long',
        'status',
        'quantum_of_sale',
        'upi_id',
        'code',
        'lang',
        'address',
        'type'
    ];

    public function latestOrders()
    {
        return $this->hasMany(LatestOrder::class);
    }
}
