@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create  @endsection
@section('content')

@component('Admin.shared.create', ['titlePage' => $titlePage, 'routeName' => $routeName])


  <form action="{{route('lectures.store')}}" method="POST" enctype="multipart/form-data">
     <div class="row">
          @include('Admin.'.$routeName.'.form')


        <div class="col-lg-12">
          <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>
          <button type="submit" class="btn btn-info" name="action" value="draft"> Save As Draft</button>
          <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Schedule</button>
          <button type="submit" class="btn btn-info" name="action" value="save_new"> Save & New</button>
          <button type="submit" class="btn btn-info" name="action" value="save_lesson"> Save & Add Lesson</button>
        </div>

      </div>
  </form>

@endcomponent
@endsection
