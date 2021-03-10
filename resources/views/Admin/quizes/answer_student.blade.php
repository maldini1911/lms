@extends('Admin.index')

@section('content')

@foreach($rows as $row)
@if($row->question->type != 'edit_image')
<div class="card">
  <div class="card-body">
          @if($row->question->type == "choise_image" )
              <h5> Type : {{$row->question->type}} </h5>
              <h5> Question :  </h5>
              <hr>
              <img src="{{url('/')}}/uploads/questions/assignments/{{$row->question}}" width="100px" height="100px">
              <hr>
              <h5> Answer :  </h5>
              <img src="{{url('/')}}/uploads/questions/assignments/{{$row->answer}}" width="100px" height="100px">
          @elseif($row->question->type == "image_true_false")
            <h5> Type :{{ $row->question->type}} </h5>
            <hr>
            <h5> Question :  </h5>
            <hr>
            <img src="{{url('/')}}/uploads/questions/assignments/{{$row->question}}" width="100px" height="100px">
            <hr>
            <h5> Answer : {{$row->answer}} </h5>
          @else
            <h5> Type : {{$row->question->type}} </h5>
            <hr>
            <h5> Question : {{$row->question->question}} </h5>
            <hr>
            <h5> Anwser :{{$row->answer}}</h5>
          @endif

  </div>
</div>
@endif
@endforeach
@endsection
