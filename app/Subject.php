<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	public $fillable = [
                'code',
                'name',
            ];

    public function courses(){
      	return $this->hasMany("App\Course", "subject_code");
    }
}
