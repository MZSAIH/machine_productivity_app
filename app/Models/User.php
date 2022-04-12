<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'is_verified'
    ];

    public $timestamps = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function getImageAttribute()
    // {
    //     return url('images/upload') . '/'.$this->attributes['image'];
    // }

    public function hasAccess($permission){
        foreach ($this->roles as $role) {
            if($role->hasPermission($permission))
                return true;
        }
        return false;
    }
    
    public function productions(){
        return $this->belongsToMany(Production::class,'operation')->withPivot('action_id');
    }

    public function actions(){
        return $this->belongsToMany(Action::class,'operation')->withPivot('production_id');
    }
}
