<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    public function roles(){
        return $this->belongsToMany(Roles::class,'role_user','user_id','role_id')->withTimestamps();
    }

    public function registeredCourses(){
        return $this->belongsToMany(Course::class,'course_user','user_id','course_id');
    }

    public function coursesCreated(){
        return $this->hasMany('App\Course');
    }



    public function assignRole($role){
        if (is_string($role)){
            $role = Roles::whereName($role)->firstOrFail();
        }
        $this->roles()->sync($role,false);
    }

    public function permissions(){
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
