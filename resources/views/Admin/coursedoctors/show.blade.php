@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Doctors & Courses @endsection

@section('content')


<div class="table-responsive">

    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
              <th>ID</th>
              <th>Doctor</th>
              <th>Course</th>
              <th>Squad Year</th>
              <th style="width:100px">Control</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
          <tr>
              <td>{{$row->id}}</td>
              <td>{{$row->doctor['name']}}</td>
              <td>{{$row->course['name']}}</td>
              <td>{{$row->academic_year}}</td>
              <td style="display:flex">
                <a href="{{url('admin/coursedoctors/edit/'.$row->id)}}" class="btn btn-success btn-md link-delete"> Edit </a>
                <a href="{{url('admin/coursedoctors/delete/'.$row->id)}}" class="btn btn-danger btn-md link-delete"> Delete </a>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
</div>

@endsection
