<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'group_id',
        'type',
    ];
    public function group(){
        return $this->belongsTo(GroupStatus::class,'group_id');
    }
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
