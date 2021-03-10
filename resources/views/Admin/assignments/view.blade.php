@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i>  Assignment  @endsection

@section('content')

<div class="row">

@if($questions->isNotEmpty())
    @foreach($questions as $question)
        @if($question->type == 'text')
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Text Question </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <h4 style="background:#eee;padding:20px;border-radius:4px">Question : {{$question->question}}</h4>
                            <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">Answer : {{$question->answer}}</h4>
                            <a href="{{url('doctors/assignments/question/delete/'.$question->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
        @endif

        @if($question->type == "choise")
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Choise Question </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <h4 style="background:#eee;padding:20px;border-radius:4px">Question : {{$question->question}}</h4>
                            <div class="row">
                            <div class="col-lg-6"> <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">1 - {{$question->choise1}}</h4></div>
                            <div class="col-lg-6"> <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">2 - {{$question->choise2}}</h4></div>
                            <div class="col-lg-6"> <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">3 - {{$question->choise3}}</h4></div>
                            <div class="col-lg-6"> <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">4 - {{$question->choise4}}</h4></div>
                            </div>
                            <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">Answer : {{$question->answer}}</h4>
                            <a href="{{url('doctors/assignments/question/delete/'.$question->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
        @endif

        @if($question->type == "true_false")
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">True OR False Question </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <h4 style="background:#eee;padding:20px;border-radius:4px">Question : {{$question->question}}</h4>
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="exampleRadios1" value="yes" name="true[]">
                                        <label class="form-check-label" for="exampleRadios1"> True</label>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="exampleRadios1" value="no" name="false[]">
                                        <label class="form-check-label" for="exampleRadios1"> False</label>
                                    </div>
                                </div>
                            </div>
                            <h4 style="background:#f2f2f2;padding:2px;border-radius:4px">Answer : {{$question->answer}}</h4>
                            <a href="{{url('doctors/assignments/question/delete/'.$question->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
        @endif

        @if($question->type == "image_true_false")
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Image True OR False Question </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <div class="row">
                                <div class="form-group videos-inputs">
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" multiple="multiple" name="question[]" required="required">
                                        <label class="custom-file-label" for="exampleInputFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="exampleRadios1" value="yes" name="true[]">
                                        <label class="form-check-label" for="exampleRadios1"> True</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="exampleRadios1" value="no" name="false[]">
                                        <label class="form-check-label" for="exampleRadios1"> False</label>
                                    </div>
                                </div>
                            </div>
                            <h4 style="background:#f2f2f2;padding:20px;border-radius:4px">Answer : {{$question->answer}}</h4>
                            <a href="{{url('doctors/assignments/question/delete/'.$question->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
        @endif

        @if($question->type == "edit_image")
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$question->title}} </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="row">
                              <?php
                               $images = explode(',', $question->question);

                               foreach($images as $img)
                               {
                                 ?>
                                 <div class="col-lg-2">
                                  <img src="{{url('/')}}/uploads/questions/assignments/editImage/{{$img}}" width="100%">
                                </div>
                                 <?php
                               }
                              ?>
                            </div>
                            <hr>
                            <a href="{{url('doctors/assignments/question/delete/'.$question->id)}}" class="btn btn-danger">Delete</a>
                        </div>
                        <hr>
                    </div>
            </div>
        </div>
        @endif

    @endforeach
@endif

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
