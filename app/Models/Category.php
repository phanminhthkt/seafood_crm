<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'type'
    ];
    // public function status(){
    // 	return $this->hasMany(Status::class,'group_id','id');
    // }
}
