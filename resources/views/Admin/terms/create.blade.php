@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => 'Squad', 'routeName' => $routeName])

<form action="{{route('terms.store')}}" method="POST">
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>

@endcomponent
@endsection
