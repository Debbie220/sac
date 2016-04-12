<form action="{{ route($route_name, $id) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('DELETE') }}

  <button type="submit" class="btn btn-link"
     aria-label="$title" title="$title">
     <i class="fa fa-trash-o"></i>
  </button>
</form>
