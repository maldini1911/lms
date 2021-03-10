@section('title-pages')
{{trans('admin.'.$routeName)}}
@endsection
<div class="row">
  <div class="col-md-12">
  <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="{{route($routeName.'.create')}}" class="btn btn-primary btn-md"> <i class="fas fa-plus-circle"></i>  Create </a>
                @yield('link')
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              {{$slot}}
            </div>
            <!-- /.card-body -->
          </div>
  </div>
</div>
@push('js')
<script>
  $(function () {
    $("#example1").DataTable(
      {
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "paging": false
      }
    );

  });
</script>
@endpush
