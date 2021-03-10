@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> All Teaching Stuff @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

@section('link')
<hr>
<form action="{{url('admin/doctor/excel')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="file" name="doctors" class="form-control">
    <br>
    <button type="submit" class="btn btn-success" style="width:200px;"> Bulk Doctors</button>
    <a href="{{url('/')}}/uploads/attachments/doctors.xlsx" class="card-link btn btn-info">  Download Sample </a>
</form>



@endsection

@include("Admin.shared.delete_all")

<div class="table-responsive">
    <!-- Start Delete All -->
    <form action="{{url('admin/doctors/delete/all')}}" method="post" id="form_delete">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">
    <!-- End Delete All -->
            <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
                    <th>ID</th>
                    <th>{{trans('admin.name')}}</th>
                    <th>{{trans('admin.email')}}</th>
                    <th>Mobile</th>
                    <th>Courses</th>
                    <th style="width:100px">Control</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td> @include('Admin.shared.buttons.checkbox')</td>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->mobile}}</td>
                    <td>  <a href="{{url('admin/coursedoctors/create/'.$row->id)}}" class="btn btn-info btn-md link-delete"> Add </a> </td>
                    <td class="flex">
                        <a href="{{route('doctors.show', ['id' => $row->id])}}" class="btn btn-info btn-md link-delete"> Show </a>
                        @include('Admin.shared.buttons.edit')
                        @include('Admin.shared.buttons.delete')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

{!! $rows->links() !!}

@endcomponent


@push('js')

<script>

delete_all();

</script>

@endpush

@endsection
