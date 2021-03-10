@extends('Admin.index')
@section('title-page') <i class="fas fa-edit"></i> Edit @endsection
@section('content')

<a href="{{url('admin/coursedoctors/show/'.$row->doctor['id'])}}" class="btn btn-primary btn-md"> Back To Page Show </a>
<hr>
<form action="{{url('admin/coursedoctors/update/'.$row->id)}}" method="POST">
    {{method_field('PUT')}}
    @include('Admin.coursedoctors.form')
    <button type="submit" class="btn btn-success"> {{trans('admin.edit')}}</button>
</form>


@endsection
