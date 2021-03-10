@extends('Admin.index')
@section('title-page') <i class="fas fa-user-edit"></i> Edit @endsection
@section('content')

@component('Admin.shared.edit', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route($routeName.'.update', $row->id)}}" method="POST" enctype="multipart/form-data">
    {{method_field('PUT')}}
    @include('Admin.'.$routeName.'.form')
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"> Save </button>
        </div>
</form>

@endcomponent
@endsection
