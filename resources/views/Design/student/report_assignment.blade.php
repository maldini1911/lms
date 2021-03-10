@extends('Admin.index')
@section('title-page')
<div style="color:red;font-weight">
     <i class="fas fa-file"></i> Report Assignment {{$assignment->assignment_code}}
</div>
@endsection
@section('content')


<div class="report-student">
    @foreach($rows as $row)
      @if($row->question->type != 'edit_image')
      <div class="card">
        <div class="card-body">
                @if($row->question->type == "choise_image" )
                    <h5> Type :
                        @if($row->question->type == 'choise_image')
                            Question Choises
                        @endif
                    </h5>
                    <hr>
                    <h5> Question :  </h5>
                    <img src="{{url('/')}}/uploads/questions/assignments/{{$row->question}}" width="100px" height="100px">
                    <hr>
                    <h5> Answer :  </h5>
                    <img src="{{url('/')}}/uploads/questions/assignments/{{$row->answer}}" width="100px" height="100px">
                @elseif($row->question->type == "image_true_false")
                  <h5> Type :
                    @if($row->question->type == 'image_true_false')
                        Question Image True OR False
                    @endif
                   </h5>
                  <hr>
                  <h5> Question :  </h5>
                  <img src="{{url('/')}}/uploads/questions/assignments/{{$row->question}}" width="100px" height="100px">
                  <hr>
                  <h5> Answer : {{$row->answer}} </h5>
                @else
                  <h5> Type :
                    @if($row->question->type == 'choise_text')
                        Question Choises
                    @endif

                    @if($row->question->type == 'true_false')
                        Question True Or False
                    @endif
                   </h5>
                  <hr>
                  <h5> Question : {{$row->question->question}} </h5>
                  <hr>
                  <h5> Anwser :{{$row->answer}}</h5>
                @endif

        </div>
      </div>
      @endif
    @endforeach
</div>
@endsection
