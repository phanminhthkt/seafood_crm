<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAttribute extends Model
{
    use HasFactory;

    protected $table = 'group_attributes';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'type'
    ];
    public function attributes(){
    	return $this->hasMany(Attribute::class,'group_id','id');
    }
}
