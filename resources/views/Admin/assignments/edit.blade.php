@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i>  Assignment  @endsection

@section('content')

<!-- Start Asignment -->
<div class="asignment-edit">
    <h4 class="alert alert-info">Edit Assignment </h4>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{url('doctors/assignments/update/'.$row->id)}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6" >
                        <div class="quize-bar" style="background:#eee;padding:20px;border-radius:4px">
                            <div class="form-group bmd-form-group">
                                    @php $input = "course_id"; @endphp
                                    <label class="bmd-label-floating" style="color:#111">Courses</label>
                                    <select name="{{$input}}" class="form-control">
                                       @isset($row)
                                       <option value="{{$row->course['id']}}"> {{$row->course['name']}} </option>
                                       @endisset
                                        @foreach($courses as $course)
                                        <option value="{{$course->course['id']}}"> {{$course->course['name']}} </option>
                                        @endforeach
                                    </select>
                                    @error($input)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            <div class="form-group bmd-form-group">
                                @php $input = "lecture_id"; @endphp
                                <label class="bmd-label-floating" style="color:#111">Lecture</label>

                                <select name="{{$input}}" class="form-control">
                                    @isset($row)
                                    <option value="{{$row->lecture['id']}}"> {{$row->lecture['title']}} </option>
                                    @endisset
                                    @foreach($lectures as $lecture)
                                        <option value="{{$lecture->id}}"> {{$lecture->title}} </option>
                                    @endforeach
                                </select>
                                @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group bmd-form-group">
                                @php $input = "code_assignment"; @endphp
                                <label class="bmd-label-floating" style="color:#111">Assignment Code </label>
                                <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}" required="required">
                                @error($input)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="fixed-data" style="background:#eee;padding:20px;border-radius:4px">

                                <div class="form-group">
                                <label for="exampleInputEmail1" style="color:#111">Assignment Scheduling </label>
                                <input type="text" name="course_scheduling" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" style="color:#111">Total Mark</label>
                                <input type="number" class="form-control" name="fullmark" value="{{$row->fullmark}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1" style="color:#111">Total Time</label>
                                <input type="number" class="form-control" name="full_time" value="{{$row->full_time}}">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-xs-12">
                        <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>
                        <button type="submit" class="btn btn-info" name="action" value="save"> Save As Draft</button>
                        <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Schedule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Assignment -->
<hr>
<!-- Start Questions Edit -->
<div class="questions-edit">
    <h4 class="alert alert-info">Edit Questions </h4>

    @if($questions->isNotEmpty())
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="text-tab" data-toggle="tab" href="#text" role="tab" aria-controls="text" aria-selected="true">Text</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="choise-tab" data-toggle="tab" href="#choise" role="tab" aria-controls="choise" aria-selected="false">Choise</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="true-false-tab" data-toggle="tab" href="#true-false" role="tab" aria-controls="true-false" aria-selected="false">True & False</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="file-true-false-tab" data-toggle="tab" href="#file-true-false" role="tab" aria-controls="file-true-false" aria-selected="false">Image True & False</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Start Text Questions -->
        <div class="tab-pane fade show active" id="text" role="tabpanel" aria-labelledby="text-tab">
            @if($questions->where('type', 'text')->isNotEmpty())
                    @foreach($questions->where('type', 'text') as $question)
                        @if($question->type == 'text')
                            <div class="col-md-12">
                                <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Text Question </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <form action="{{url('doctors/assignments/questions/update/'.$question->id)}}" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1"> Question text </label>
                                                    <textarea class="form-control" rows="3" name="question_text"> {{$question->question}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="exampleFormControlInput1">Answer</label>
                                                        <input type="text" class="form-control" name="answer" value="{{$question->answer}}">
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                                </div>
                                                <hr>
                                            </form>
                                        </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
            @else
                <h4 class="alert alert-danger text-center">Not Found Any Questions </h4>
            @endif
        </div>
        <!-- End Text Questions -->

        <!-- Start Choise Questions -->
        <div class="tab-pane fade" id="choise" role="tabpanel" aria-labelledby="choise-tab">
            @if($questions->where('type', 'choise_text')->isNotEmpty() OR $questions->where('type', 'choise_image')->isNotEmpty())
                @foreach($questions as $question)
                    @if($question->type == "choise_text")
                        <div class="col-md-8">
                            <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Choise Question </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                    <form action="{{url('doctors/assignments/questions/update/'.$question->id)}}" method="POST">
                                            {{csrf_field()}}
                                        <!-- Start Text Choise -->
                                        <div class="text-choise">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Question</label></label>
                                                <input type="text" class="form-control" name="question_choice_text" value="{{$question->question}}">
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">(1)</label>
                                                        <input type="text" class="form-control" name="choice1" value="{{$question->choise1}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">(2)</label>
                                                        <input type="text" class="form-control" name="choice2" value="{{$question->choise2}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">(3)</label>
                                                        <input type="text" class="form-control" name="choice3" value="{{$question->choise3}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">(4)</label>
                                                        <input type="text" class="form-control" name="choice4" value="{{$question->choise4}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Answer</label>
                                                        <input type="text" class="form-control" name="answer" value="{{$question->answer}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Text Choise -->
                                        <button type="submit" class="btn btn-success">Edit</button>
                                        <hr>
                                    </form>
                                    </div>
                            </div>
                        </div>
                    @endif

                    @if($question->type == 'choise_image')
                        <div class="card">
                            <div class="card-body">
                            <form action="{{url('doctors/assignments/questions/update/'.$question->id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Question title</label></label>
                                                <input type="text" class="form-control" name="title" value="{{$question->title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Question</label></label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->question}}" width="20%">
                                                <hr>
                                                <input type="file" class="form-control" name="question">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                                <div class="form-group">
                                                <label for="exampleFormControlInput1">(1)</label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise1}}" width="50%" height="200px">
                                                <hr>
                                                <input type="file" class="form-control" name="choise1">
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                                <div class="form-group">
                                                <label for="exampleFormControlInput1">(2)</label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise2}}"width="50%" height="200px">
                                                <hr>
                                                <input type="file" class="form-control" name="choise2">
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                                <div class="form-group">
                                                <label for="exampleFormControlInput1">(3)</label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise3}}" width="50%" height="200px">
                                                <hr>
                                                <input type="file" class="form-control" name="choise3">
                                            </div>
                                        </div>

                                        <div class="col-lg-5">
                                                <div class="form-group">
                                                <label for="exampleFormControlInput1">(4)</label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise4}}" width="50%" height="200px">
                                                <hr>
                                                <input type="file" class="form-control" name="choise4">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Answer</label>
                                                <input type="number" class="form-control" name="answer" value="{{$question->answer}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Edit</button>
                                <hr>
                            </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h4 class="alert alert-danger text-center">Not Found Any Questions </h4>
            @endif
        </div>
        <!-- End Questions -->

        <!-- Start Ture False Questions -->
        <div class="tab-pane fade" id="true-false" role="tabpanel" aria-labelledby="true-false-tab">
            @if($questions->where('type', 'true_false')->isNotEmpty())
                @foreach($questions->where('type', 'true_false') as $question)
                    @if($question->type == "true_false")
                        <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">True OR False Question </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                    <form action="{{url('doctors/assignments/questions/update/'.$question->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1"> Question</label>
                                            <input type="text" class="form-control" name="question_correct" required="required" value="{{$question->question}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Choise Right Answer </label>
                                            <select name="answer" class="form-control">
                                                    <option value="{{$question->answer}}">{{$question->answer}}</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h4 class="alert alert-danger text-center">Not Found Any Questions </h4>
            @endif
        </div>
        <!-- End Questions -->

        <!-- Start Image True Or False -->
        <div class="tab-pane fade" id="file-true-false" role="tabpanel" aria-labelledby="file-true-false-tab">
            @if($questions->where('type', 'image_true_false')->isNotEmpty())
                @foreach($questions->where('type', 'image_true_false') as $question)
                    @if($question->type == "image_true_false")
                        <div class="col-md-8">
                            <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Image True OR False Question </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                    <form action="{{url('doctors/assignments/questions/update/'.$question->id)}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">The title of the question</label>
                                            <input type="text" class="form-control" name="title_file" value="{{$question->title}}">
                                            </div>

                                            <div class="form-group videos-inputs">
                                                <label for="exampleInputFile">Image Question</label>
                                                <hr>
                                                    <img src="{{url('/')}}/uploads/questions/assignments/{{$question->question}}" width="20%">
                                                <hr>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="question_file">
                                                    <label class="custom-file-label" for="exampleInputFile"></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Choise Right Answer </label>
                                                <select name="answer" class="form-control">
                                                        <option value="{{$question->answer}}">{{$question->answer}}</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                </select>
                                            </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <h4 class="alert alert-danger text-center">Not Found Any Questions </h4>
            @endif
        </div>
        <!-- End Image True Or false -->
    </div>
    @else
    <h4 class="alert alert-danger text-center">Not Found Any Questions </h4>
    @endif

</div>
<!-- End Questions Edit -->
@push('js')
<script>
  $(function () {
    $("#example1").DataTable(
      {
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "paging": false
      }
    );

  });
</script>
@endpush
@endsection
