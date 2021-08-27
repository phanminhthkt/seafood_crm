<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
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
        'is_status'
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
    public function isSuperAdmin()
    {   
         foreach($this->roles as $v){
            if($v->slug == 'admin'){
                return true;
            }else{
                return false;
            }
         }
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
