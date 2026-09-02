<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class CustomerPayoutAccount extends Model
{
    use UsesUUID;

    protected $fillable = [
        'id',
        'pay_id',
        'customer_name',
        'customer_mobile',
        'customer_email',
        'contact_id',
        'fund_account_id',
        'vpa_address',
        'account_type',
        'is_active',
    ];
}
