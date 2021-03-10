@extends('Admin.index')
@section('title-page') <i class="fas fa-edit"></i> Edit @endsection
@section('content')

@component('Admin.shared.edit', ['titlePage' => 'Squad', 'routeName' => $routeName])

<form action="{{route($routeName.'.update', $row->id)}}" method="POST">
    {{method_field('PUT')}}
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.edit')}}</button>
</form>

@endcomponent
@endsection
