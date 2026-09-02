<?php

namespace App\Models;

use AjayKushwaha25\CustomMakeCommand\Traits\UsesUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    use HasFactory, UsesUUID;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status'
    ];

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }
}
