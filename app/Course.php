<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function users(){
        return $this->belongsToMany('App\User','course_user','course_id','user_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class,'category_course','course_id','category_id');
    }

    public function topics(){
        return $this->hasMany(Topic::class);
    }
}
