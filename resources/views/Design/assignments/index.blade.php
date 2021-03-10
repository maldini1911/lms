@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> All Faculties @endsection

@section('content')

<div class="row">
  <div class="col-md-12">
  <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <a href="{{url('assignments/create')}}">  Create Assignment</a>
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{trans('admin.code_assignment')}}</th>
                                <th>{{trans('admin.subject_name')}}</th>
                                <th>{{trans('admin.view_assignment')}}</th>
                                <th>Created_at</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->code_assignment}}</td>
                                <td>{{$row->subject->name}}</td>
                                <td>
                                    <a href="{{url('assignments/view/'.str_replace(' ', '-', $row->code_assignment))}} " class="btn btn-info">View</a>
                                </td>
                                <td>{{$row->created_at}}</td>
                                <td>
                                    <a href="{{url('assignments/edit')}}" class="link-edit"> <i class="fas fa-user-edit"></i> </a>
                                    <a href="{{url('assignments/delete')}}" class="link-delete"> <i class="fas fa-user-times"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {!!$assignments->links() !!}
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
