<div class="col-md-10">
<table class="table">
    <tr class="row">
      <th class="col-lg-8 col-md-8 col-sm-8 text-center"></th>
      <th class="col-lg-2 col-md-2 col-sm-2 text-center">OUR Nominee</th>
      <th class="col-lg-2 col-md-2 col-sm-2 text-center">Type</th>
    </tr>

    @foreach($presentations as $index=>$p)
    <tr class="row">
        <td>
            <h4>
                <a data-toggle="collapse"
                    href="#{{$index}}" aria-expanded="false"
                    aria-controls="details">
                    {{$p['title']}}
                </a>
            </h4>
            <div id="{{$index}}" class="collapse">
                <p>
                    <b>Professor:</b> {{ $p['professor_name'] }}
                </p>
                <p>
                    <b>Student:</b> {{ $p['student_name'] }}
                </p>
                <p>
                    {{$p['abstract']}}
                </p>
            </div>
        </td>
        <td class="text-center">
            {{ $p['our_nominee'] ? 'Yes' : 'No' }}
        </td>
        <td class="text-center">
            {{ $presentation_types[$p['type']]['description'] }}
        </td>

    </tr>
    @endforeach
</table>
</div>
