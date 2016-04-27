@foreach($presentations as $p)
  @if($p->timeslot()->get()->first()->room_code == $room['code'])
    @if($p->timeslot()->get()->first()->day == $day)
    <tr class="row">
        <td class="text-center">
            <p>
                {{ $p->timeslot()->get()->first()->time}}
            </p>
        </td>
        <td class="text-center">
            <p>
                {{ $p->owner()->get()->first()->name}}
            </p>
        </td>
        <td class="text-center">
            <p>
                {{ $p['title']}}
            </p>
        </td>
        <td class="text-center">
            <p>
                {{ $p->course()->get()->first()->subject_code}}
            </p>
        </td>
        <td class="text-center">
            <p>
                {{ $p['professor_name']}}
            </p>
        </td>
        <td class="text-center">
            <p>
                {{ $p->type()->get()->first()->description}}
            </p>
        </td>
    </tr>
      <td colspan="6" style="border-top-width:0;">
        <a data-toggle="collapse"
          data-target="#{{$p['id']}}"> <h4> View Abstract </h4> </a>
        <div id = "{{$p['id']}}" class= "collapse">
          {{$p['abstract']}}
        </div>
      </td>
    @endif
  @endif
@endforeach
