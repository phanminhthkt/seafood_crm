<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'members';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'type',
        'group_id',
        'is_status',
        'is_priority',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group(){
        return $this->belongsTo(GroupMember::class,'group_id');
    }
    public function isSuperAdmin()
    {   
         foreach($this->group->roles as $v){
            if($v->slug == 'admin'){
                return true;
            }else{
                return false;
            }
         }
    }
    
    // public function projects(){
    //     return $this->belongsToMany(Project::class);
    // }
}
