<?php 
    use App\Conference;
    use App\Presentation;


    function current_conference(){
    	$id = get_current_conference_id();
        return Conference::find($id);
    }

    function count_presentations(){
    	$id = get_current_conference_id();
    	return Presentation::where('conference_id', '=', $id)->count();
    }

    function get_current_conference_id(){
        return Conference::max('id');
    }
?>