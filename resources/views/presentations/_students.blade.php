<div class="form-group">
    <label class="col-md-3 control-label">Student Name</label>

    <div class="col-md-5">
        <input type="text" class="form-control" name="student_name[]"
            value="{{ !empty($students) ? $students[0]->student_name : 
            Auth::user()->is_student() ? Auth::user()->name : '' }}" 
            {{ Auth::user()->is_student() ? 'readonly' : '' }}>
    </div>

    <div class="col-md-1 checkbox">
        <label>
            <input type="checkbox" id="group-checkbox"
                {{ $presentation->is_group() ?'checked' : ''}}> Group
        </label>
    </div>
</div>

<div id="new-students">
@if(!empty($students))
    @for($i = 1; $i < count($students); $i++)
        <div class="form-group new-student">
            <label class="col-md-3 control-label">Student Name</label>

            <div class="col-md-5">
                <input type="text" class="form-control" name="student_name[]"
                value="{{ $students[$i]->student_name }}" >
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                <a class="btn btn-default" href="#" onclick="addStudent();">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
    @endfor
@endif
</div>

<div class="hidden form-group new-student">
    <label class="col-md-3 control-label">Student Name</label>

    <div class="col-md-5">
        <input type="text" class="form-control" name="student_name[]"
            disabled="true" >
    </div>

    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
        <a class="btn btn-default" href="#" onclick="addStudent();">
            <i class="fa fa-plus"></i>
        </a>
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