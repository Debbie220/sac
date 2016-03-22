{{ csrf_field() }}
<div class="form-group{{ $errors->has('professor_name') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Professor Name</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="professor_name"
            value="{{ old('professor_name', $presentation['professor_name']) }}"
            {{ Auth::user()->is_professor() ? 'disabled' : '' }}>

        @if ($errors->has('professor_name'))
            <span class="help-block">
                <strong>{{ $errors->first('professor_name') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('student_name') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Student Name</label>

    <div class="col-md-5">
        <input type="text" class="form-control" name="student_name[]"
            value="{{ Auth::user()->is_student() ? Auth::user()->name : 
                old('student_name') }}" >

        @if ($errors->has('student_name'))
            <span class="help-block">
                <strong>{{ $errors->first('student_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-1 checkbox">
        <label>
            <input type="checkbox" id="group-checkbox"> Group
        </label>
    </div>
</div>

<div id="new-students">
@foreach($presentation->students() as $student)
    <div class="form-group new-student">
        <label class="col-md-3 control-label">Student Name</label>

        <div class="col-md-5">
            <input type="text" class="form-control" name="student_name[]"
            value="{{ old('student_name', $student->student_name) }}" >

            @if ($errors->has('student_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('student_name') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
            <a class="btn btn-default" href="#" onclick="addStudent();">
                <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
@endforeach
</div>

<div class="hidden form-group new-student">
    <label class="col-md-3 control-label">Student Name</label>

    <div class="col-md-5">
        <input type="text" class="form-control" name="student_name[]"
            value="{{ old('student_name', $presentation['student_name']) }}"
            disabled="true" >

        @if ($errors->has('student_name'))
            <span class="help-block">
                <strong>{{ $errors->first('student_name') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
        <a class="btn btn-default" href="#" onclick="addStudent();">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>

<div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Course</label>

    <div class="col-md-6">
        <select type="text" class="form-control" name="course_id">
            <option value=""> Select a course </option>
            <option value="" disabled >---------</option>

            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{old('course_id', $presentation['course_id']) ==
                     $course->id ? 'selected' : ''}}>
                {{ $course->subject_code." ". $course->number." - ".$course->title }}</option>
            @endforeach
        </select>

        @if ($errors->has('course_id'))
            <span class="help-block">
                <strong>{{ $errors->first('course_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Title</label>

    <div class="col-md-6">
        <input type="text" class="form-control" name="title"
            value="{{ old('title', $presentation['title']) }}">

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Type</label>

    <div class="col-md-6">
        <select id="select-beast" type="text" class="form-control" name="type"
            >
            <option value="">Select a presentation type</option>
            <option value="" disabled>---------</option>
            @foreach($presentation_types as $type)
                <option value="{{ $type->id }}"
                    {{old('type', $presentation['type']) == $type->id ? 'selected' : ''}}>
                {{ $type->description }}</option>
            @endforeach
        </select>

        @if ($errors->has('type'))
            <span class="help-block">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('abstract') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Abstract</label>

    <div class="col-md-6">
        <textarea abstract="text" class="form-control"
            name="abstract">{{ old('abstract', $presentation['abstract']) }}</textarea>

        @if ($errors->has('abstract'))
            <span class="help-block">
                <strong>{{ $errors->first('abstract') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('special_notes') ? ' has-error' : '' }}">
    <label class="col-md-3 control-label">Special Notes</label>

    <div class="col-md-6">
        <textarea special_notes="text" class="form-control"
            name="special_notes" >{{ old('special_notes', $presentation['special_notes']) }}</textarea>

        @if ($errors->has('special_notes'))
            <span class="help-block">
                <strong>{{ $errors->first('special_notes') }}</strong>
            </span>
        @endif
    </div>
</div>

@if(!Auth::user()->is_student())
<div class="form-group{{ $errors->has('our_nominee') ? ' has-error' : '' }}">
    <div class="col-md-offset-3 col-md-6">
        <label>Nominate this student for an OUR?</label>
        <div class="radio">
        <input type="radio" class="" name="our_nominee" id="yes"
            value="1" {{ old('our_nominee', $presentation['our_nominee']) == true ? 'checked' : 'test'}}>
            <label class="">Yes</label>
        </div>
        <div class = "radio">
        <input type="radio" class="" name="our_nominee" id="no"
            value="0" {{ old('our_nominee', $presentation['our_nominee']) == false ? 'checked' : 'test2'}}>
            <label class="">No</label>
        </div>

        @if ($errors->has('our_nominee'))
            <span class="help-block">
                <strong>{{ $errors->first('our_nominee') }}</strong>
            </span>
        @endif
    </div>
</div>
@endif

<div class="form-group">
    <div class="col-md-6 col-md-offset-6">
        <a class="btn btn-default" href="{{ route('home') }}">
            <i class="fa fa-arrow-left"></i>
            Cancel
        </a>

        <button type="submit" class="btn btn-primary">
            <i class="fa fa-floppy-o"></i> Save
        </button>
    </div>
</div>


@section('scripts')
<script type="text/javascript">
    function addStudent(){
        var student = $(".new-student").last().clone();
        student.removeClass("hidden");
        student.find("input").prop('disabled', false);
        student.appendTo("#new-students");
    }
    $(document).ready(function(){

        $("#group-checkbox").click(function(){
            var checkbox = $("#group-checkbox");
            if($("#group-checkbox").is(":checked")){
                addStudent();
            }else{
                $("#new-students").empty();
            }
        });

    });
</script>
@stop