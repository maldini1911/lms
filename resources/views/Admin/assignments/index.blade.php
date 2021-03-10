@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> All Assignments @endsection

@section('content')
<div class="row">
  <div class="col-md-12">
  <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="{{url('doctors/assignments/create')}}" class="btn btn-primary btn-sm"> <i class="fas fa-plus-circle"></i> Create Assignment</a>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @include("Admin.shared.delete_all")
                <div class="table-responsive">
                    <!-- Start Delete All -->
                    <form action="{{url('doctors/assignments/delete/all')}}" method="post" id="form_delete">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <!-- End Delete All -->
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th> View Answers </th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rows as $row)
                                <tr>
                                    <td> @include('Admin.shared.buttons.checkbox')</td>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->code_assignment}}</td>
                                    <td>{{$row->course->name}}</td>
                                    <td>{{$row->course_status}}</td>
                                    <td> <a href="{{url('doctors/assignments/edit/image/answers/'.$row->id)}} " class="btn btn-md btn-info">View</a></td>
                                    <td>
                                        <a href="{{url('doctors/assignments/view/'.$row->id)}} " class="btn btn-md btn-info">Show</a>
                                        <a href="{{url('doctors/assignments/edit/'.$row->id)}} " class="btn btn-md btn-success">Edit</a>
                                        <a href="{{url('doctors/assignment/delete/'.$row->id)}}" class="btn btn-md btn-danger"> delete </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            {!! $rows->links() !!}
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
@endsection
