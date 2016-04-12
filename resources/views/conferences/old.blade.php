@extends('user.admin.basepage')

@section('header')
Old Conferences
@stop

@section('admin_content')

    <form action="{{ route('conference.old') }}" method="GET">
        <div class="col-lg-11 col-md-11 col-sm-11 col-xs-9 text-center">
            <select type="text" class="form-control" name="id" >
                <option value=""> Select a conference </option>
                <option value="" disabled >---------</option>

                @foreach($conferences as $conference)
                    <option value="{{ $conference->id }}">
                    {{ $conference->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
            <button type="submit" class="btn btn-default" id="add_course">
                Select Conference
            </button>
        </div>
    </form>

    <br><br>
        <h3><b> {{ $chosen_conf->description }} </b> selected.</h3>
    <hr>

    @forelse($presentations as $p)
        <div class="row ">
            <div class="col-lg-8 col-md-8 col-sm-8 info">
                <h4>
                    {{$p['title']}}
                </h4>
                <div>
                    <p>
                        <b>Professor:</b> {{ $p['professor_name'] }}
                    </p>
                    <p>
                        <b>Course:</b> {{$p->course->toString()}}
                    </p>
                    <p>
                        <b>Students:</b>
                        <ul class="list-unstyled">
                        @foreach($p->students() as $student)
                            <li>{{ $student->student_name }}</li>
                        @endforeach
                        </ul>
                    </p>
                    <p>
                        <b>Abstract:</b> {{$p['abstract']}}
                    </p>

                </div>
            </div>


            <div class="col-lg-1 col-md-1 col-sm-1 text-center">
                @if($p['our_nominee'])
                    <span title="OUR Nominee"><i class="fa fa-star fa-lg"></i></span>
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 ">
                {{$p->course->subject_code . " " . $p->course->number}}
            </div>

            <div class="col-lg-1 col-md-1 col-sm-1 ">
                <p class = "
                    @if($p->status == 'S')
                        label label-warning
                    @elseif($p->status == 'D')
                        label label-danger
                    @elseif($p->status == 'A')
                        label label-success
                    @else
                        label label-info
                    @endif">
                    {{ $p->status()->get()->first()->description }}
                </p>
            </div>
        </div>
        <hr>
    @empty
        <h4>No approved presentations found for this conference or no conference selected!</h4>
    @endforelse
@stop