<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'group_id',
        'type',
    ];
    public function group(){
        return $this->belongsTo(GroupAttribute::class,'group_id');
    }
}
