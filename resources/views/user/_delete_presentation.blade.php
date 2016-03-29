 <form action="{{ route('presentation.destroy', $id) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-link" 
            aria-label="Delete Presentation" title="Delete Presentation">
        <i class="fa fa-trash-o"></i>
    </button>
</form>