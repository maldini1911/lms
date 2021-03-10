@extends('Admin.index')

@section('content')

<div class='show-doctor'>
    <a href="{{url('admin/specialties')}}" class="btn btn-primary"> All {{trans('admin.departments')}}</a>
    <hr>
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped text-center">
          <tr>
                <th> {{trans('admin.university')}}</th>
                <th> {{$row->faculty->university['name']}}</th>
          </tr>

          <tr>
                <th> {{trans('admin.faculty_name')}}</th>
                <th> {{$row->faculty['name']}}</th>
          </tr>

          <tr>
                <th> {{trans('admin.specialty')}}</th>
                <th> {{$row->name}}</th>
          </tr>

          <tr>
                <th> {{trans('admin.academic_years')}}</th>
                <th> {{$row->years}} Years</th>
          </tr>

    </table>
    </div>
</div>
@endsection
