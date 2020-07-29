<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $guarded = [];

    public function roles(){
        return $this->belongsToMany(Roles::class,'permission_roles','permission_id','role_id')->withTimestamps();
    }
}
