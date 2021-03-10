@extends('Admin.index')

@section('title-page') <i class="fas fa-user-plus"></i>  Create  @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>

@endcomponent
@endsection
