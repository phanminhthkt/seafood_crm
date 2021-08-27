<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStatus extends Model
{
    use HasFactory;

    protected $table = 'group_status';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'type'
    ];
    public function status(){
    	return $this->hasMany(Status::class,'group_id','id');
    }
}
