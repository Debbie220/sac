<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function presentations(){
        return $this->hasMany("App\Presentation", "owner");
    }

    public function courses(){
        return $this->belongsToMany('App\Course', 'user_courses');
    }

    public function is_student(){
        return $this->role == 'student';
    }

    public function is_professor(){
        return $this->role == 'professor';
    }

    public function is_admin(){
        return $this->role == 'admin';
    }

    public function make_student(){
        return $this->role = 'student';
    }

    public function make_professor(){
        return $this->role = 'professor';
    }

    public function make_admin(){
        return $this->role = 'admin';
    }
}
