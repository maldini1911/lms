<form  action="{{route($routeName.'.destroy',  $row->id)}}" method="POST">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <button type="submit" rel="tooltip" class="btn btn-md btn-danger link-delete">
    <!--<i class="fas fa-user-times"></i>-->

    Delete
    </button>
</form>

<!--

removed link-delete class from button
-->
