<div class="form-group">
    <label class="col-md-3 control-label">Student Name</label>

    <div class="col-md-5">
        <input type="text" class="form-control" name="student_name[]"
            @if(Auth::user()->is_student())
                value="{{ Auth::user()->name }}"
                readonly
            @elseif(!empty($students))
                value="{{ $students[0]->student_name }}"
            @endif
            >
            
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
<script src="{{ asset('js/add_student.js') }}"></script>
@stop