<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $fillable = [
                'subject_code',
                'number',
                'title',
            ];

    public function presentations(){
        return $this->hasMany("App\Presentation", "course_id");
    }

    public function subject(){
        return $this->belongsTo("App\Subject", "subject_code");
    }

    public function professors(){
        return $this->belongsToMany('App\User', 'user_courses');
    }
}
