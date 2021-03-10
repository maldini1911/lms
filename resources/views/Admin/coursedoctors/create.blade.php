@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create @endsection
@section('content')


<a href="{{url('admin/coursedoctors/show/'.$doctor->id)}}" class="btn btn-primary btn-md"> Show Page </a>
<hr>
<form action="{{url('admin/coursedoctors/store')}}" method="POST">
    @include('Admin.coursedoctors.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.add')}}</button>
</form>


@endsection
