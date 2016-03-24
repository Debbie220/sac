<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $incrementing = false;
    protected $primaryKey = ['room_code', 'day', 'time'];
}
