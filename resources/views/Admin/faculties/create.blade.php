@extends('Admin.index')

@section('title-page') <i class="fas fa-school nav-icon"></i>  Create  @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route('faculties.store')}}" method="POST">
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>

@endcomponent
@endsection
