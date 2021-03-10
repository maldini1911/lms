@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => 'Courses', 'routeName' => $routeName])

<form action="{{route('courses.store')}}" method="POST">
    @include('Admin.'.$routeName.'.form')
    <hr>
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>

@endcomponent
@endsection
