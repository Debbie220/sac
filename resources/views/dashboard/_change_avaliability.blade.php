<form action="{{ route('changeAvaliability', $id) }}" method="post">
  {!! csrf_field() !!}
  {!! method_field('PUT') !!}


  <button type="submit" class="btn btn-success"
  aria-label="Change Avaliability" title="Change Avaliability">Avaliable</button>

  <!-- <button type="submit" class="btn btn-link"
  aria-label="Delete Room" title="Delete Room">
  <i class="fa fa-trash-o"></i>
  </button> -->
</form>                                                                                                                                                                                                                                                                                                         
