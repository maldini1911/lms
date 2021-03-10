@extends('Admin.index')

@section('title-page')
<i class="fas fa-users" style="color:#13C5EB"></i> All Admins <hr>
@endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

<div class="table-responsive">
    <table id="admins" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th style="width:50px">ID</th>
            <th>{{trans('admin.name')}}</th>
            <th>{{trans('admin.email')}}</th>
            <th>Permissions</th>
            <th style="width:100px">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row['role']}}</td>
            <td class="flex">
                <a href="{{url('admin/users/'.$row->id)}}" class="btn btn-info btn-md link-delete"> show </a>
                @include('Admin.shared.buttons.edit')
                @include('Admin.shared.buttons.delete')
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
{!! $rows->links() !!}

@endcomponent


@push('js')
<script>
  $(function () {
    $("#admins").DataTable(
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
