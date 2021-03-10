@extends('Admin.index')

@section('title-page') <i class="fas fa-film nav-icon"></i> All Interactive Sessions@endsection

@section('content')

<div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            @foreach($rows->specialties as $row)
                @foreach($row->courses as $row)

                @foreach($doctors->where('course_id', $row->id) as $row)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">
                      <h4> {{$row->name}} </h4>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-8">
                        <hr>
                        <h2 class="lead"><b></b></h2>
                        <h5> {{$row->course['name']}}  </h5>
                        <hr>
                        <h5> {{$row->course->specialty->term['academic_year']}}  </h5>
                      </div>
                      <div class="col-4 text-center">
                        <img src="{{url('/')}}/adminlte/img/avatar2.png" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">
                      <a href="{{url('view/interactive/seesions/'.$row->id)}}" class="btn btn-md btn-primary">
                        <i class="fas fa-user"></i> Interactive Sessions
                      </a>
                    </div>
                  </div>
                </div>
                </div>
                @endforeach
                @endforeach
            @endforeach
            </div>
          </div>
        </div>
      </div>

@push('js')

<script>
$(document).ready( function () {
    $('#sessions').DataTable();
});
</script>


@endpush
@endsection
