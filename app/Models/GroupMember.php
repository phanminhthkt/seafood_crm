<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $table = 'group_members';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'type'
    ];
    public function members(){
    	return $this->hasMany(Member::class,'group_id','id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function hasPermission(Permission $permission){
        foreach($this->roles as $v){
            if($v->permissions->contains($permission)){
                return true;
            }else{
                return false;
            }
        }
        // return !! optional(optional($this->roles->first())->permissions)->contains($permission);
    }  
    // !! ép kiểu true false
}
