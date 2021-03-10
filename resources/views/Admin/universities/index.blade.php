@extends('Admin.index')

@section('title-page') <i class="fas fa-school nav-icon"></i> All Universities @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

<div class="table-responsive">
    <table id="example1" class="table table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>{{trans('admin.name')}}</th>
            <th style="width:100px">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td style="display:flex;">
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
