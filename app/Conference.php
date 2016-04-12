<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    public function presentations(){
        return $this->hasMany("App\Presentation", "conference_id");
    }
}
