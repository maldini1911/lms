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
              <th>Squad</th>
              <th style="width:50px">Control</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
              <td>{{$row->id}}</td>
              <td>{{$row->doctor['name']}}</td>
              <td><a href="{{url('admin/coursedoctors/show/'.$row->doctor['id'])}}" class="btn btn-info btn-md"> View </a></td>
              <td>{{$row->academic_year}}</td>
              <td style="display:flex">
              <a href="{{url('admin/coursedoctors/create/'.$row->doctor['id'])}}" class="btn btn-info btn-md link-delete"> Add </a>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
</div>
{!! $rows->links() !!}

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

@endsection
