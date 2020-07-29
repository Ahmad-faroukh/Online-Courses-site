<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany('App\User','role_user','role_id','user_id')->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany(Permissions::class,'permission_role','role_id','permission_id')->withTimestamps();
    }

    public function grantPermission($permission){
        if(is_string($permission)){
            $permission = Permissions::whereName($permission)->firstOrFail();
        }
        $this->permissions()->sync($permission,false);
    }


}
