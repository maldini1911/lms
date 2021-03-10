@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i>  {{trans('admin.teaching')}}  @endsection

@section('content')

@if($rows->isNotEmpty())
    <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            @foreach($rows as $row)
                @foreach($row->courses_doctors as $course)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                  <div class="card-header text-muted">
                    <h4> {{str_replace('_', ' ', $row->role)}} </h4>
                    <h4> {{$row->name}} </h4>
                  </div>

                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-8">
                        <hr>
                        <h2 class="lead"><b></b></h2>
                        <h5>  {{$course->course['name']}} </h5>
                        <hr>
                        <h5> {{$course->course->specialty['name']}} </h5>
                      </div>
                      <div class="col-4 text-center">
                        <img src="{{url('/')}}/uploads/doctors/{{$row->image}}" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-center">
                      <a href="{{url('lectures/'. $course->course['id'])}}" class="btn btn-md btn-info">
                        <i class="fas fa-user"></i> View Lectures
                      </a>
                      <a href="{{url('lessons/'.$course->course['id'])}}" class="btn btn-md btn-info">
                        <i class="fas fa-user"></i> View Lessons
                      </a>
                    </div>
                  </div>
                </div>
                </div>
                @endforeach
            @endforeach
            </div>
          </div>
        </div>
      </div>
@endif
@endsection
