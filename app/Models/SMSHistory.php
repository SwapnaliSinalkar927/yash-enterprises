<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class SMSHistory extends Model
{
    use HasFactory, UsesUUID;

    protected $fillable =[
        'wholesaler_survey_detail_id',
        'text',
        'response',
        'status',
    ];

    protected $casts = [
        'response' => 'array'
    ];

}
