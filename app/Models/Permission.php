<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'module', 'action', 'type','is_status','is_priority',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role')->withTimestamps();;
    }
}
