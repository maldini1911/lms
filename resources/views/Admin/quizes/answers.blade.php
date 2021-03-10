@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Answers Students <hr> @endsection

@section('content')


@if($rows->isNotEmpty())
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
              <th> Student</th>
              <th> Course</th>
              <th> View Answer Edit Image</th>
              <th> All Answers</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
            @if($row->question['type'] == "edit_image")
          <tr>
            <th> {{$row->student['name']}}</th>
            <th> {{$row->quize->course['name']}}</th>
            <!-- Start Show Image Before Edit -->
            <th> <a href="{{url('doctors/quizes/view/answers/'.$row->id)}} " class="btn btn-md btn-info">Show</a></th>
            <th> <a href="{{url('doctors/quizes/all/answers/'.$row->student['id'].'/'.$row->quize['id'])}} " class="btn btn-md btn-info">All Answers</a></th>
          </tr>
          @endif
          @endforeach
      </tbody>
    </table>
</div>

@else
<h4 class="alert alert-danger text-center" style="color:#111"> Not Found Any Answers For This Quize</h4>
@endif

@endsection
