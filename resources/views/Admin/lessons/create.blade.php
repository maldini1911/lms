@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create  @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route('lessons.store')}}" method="POST" enctype="multipart/form-data">

    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>
    <button type="submit" class="btn btn-info" name="action" value="draft"> Save As Draft</button>
    <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Schedule</button>
    <button type="submit" class="btn btn-info" name="action" value="save_add"> Save & New</button>

</form>

@endcomponent
@endsection
