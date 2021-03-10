@section('title-pages')
{{trans('admin.'.$routeName)}}
@endsection
<div class="row">
  <div class="col-12 col-xl-12 col-lg-12">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <a href="{{route($routeName.'.index')}}" class="btn btn-primary"> All {{$titlePage}}</a>
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
