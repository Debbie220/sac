<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Presentation extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'submitted' => 'boolean',
        'approved' => 'boolean'
    ];

    protected $guarded = ['id', 'owner'];

    protected $dates = ['submitted_at', 'approved_at'];

    public function conference(){
        return $this->belongsTo("App\Conference", "conference_id");
    }

    public function course(){
        return $this->belongsTo("App\Course", "course_id");
    }

    public function type(){
        return $this->belongsTo("App\PresentationType", "type");
    }

    public function owner(){
        return $this->belongsTo("App\User", "owner");
    }

    public function status(){
        return $this->belongsTo("App\Status", "status");
    }

    public function students(){
        return DB::table('presentation_students')->
            select('student_name')->
            where('presentation_id', '=', $this->id)->get();
    }

    public function is_group(){
        return count($this->students()) > 1;
    }

    public function timeslot(){
      return $this->belongsTo("App\Timeslot", "timeslot");
    }
}
