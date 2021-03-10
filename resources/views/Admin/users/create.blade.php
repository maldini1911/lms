@extends('Admin.index')

@section('title-page')
<i class="fas fa-user-plus" style="color:#13C5EB"></i> Create <hr>
@endsection

@section('content')

@component('Admin.shared.create', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>


@endcomponent
@endsection
