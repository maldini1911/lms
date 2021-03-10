@extends('Admin.index')

@section('title-page') <i class="fas fa-school"></i> All Departments @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Department</th>
            <th>Faculty</th>
            <th>Years</th>
            <th style="width:100px">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name}} </td>
            <td>{{$row->faculty->name}}</td>
            <td>{{$row->years}} Years</td>
            <td style="display:flex;margin:auto">
                <a href="{{url('admin/specialties/show/'.$row->id)}}" class="btn btn-info"> {{trans('admin.show')}} </a>
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

@endsection
