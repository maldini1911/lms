@extends('Admin.index')

@section('title-page') <i class="fas fa-school"></i> All Squad @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Squad</th>
            <th>{{trans('admin.term')}}</th>
            <th>{{trans('admin.faculty_name')}}</th>
            <th style="width:100px">Control</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>@include('Admin.terms.show_years')</td>
            <td>@include('Admin.terms.show_terms')</td>
            <td>{{$row->faculty['name']}}</td>

            <td class="flex">
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
