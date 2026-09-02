<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;

class TeamLeader extends Model
{
    use HasFactory,UsesUUID;

    protected $fillable = [
        'id',
        'branch_id',
        'latest_wd_id',
        'tl_id',
        'name',
        'mobile_number',
        'am',
        'ae',
        'status',
    ];
}
