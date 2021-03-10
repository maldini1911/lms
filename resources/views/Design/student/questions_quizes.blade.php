@if($questions->isNotEmpty())

    <!-- Start -->
    @if($questions->where('type', 'choise_text')->isNotEmpty() OR $questions->where('type', 'choise_image')->isNotEmpty())
    <section>
        @foreach($questions  as $question)
            <h3 id='time-question-choise' style="color:red">{{$question->time}}</h3>
            <!-- Start Choise Text -->
            @if($question->type == "choise_text")
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>{{$question->question}}</h2>
                        </div>

                        <div class="col-lg-6" style="margin:20px 0">
                            <h4>[1] {{$question->choise1}}</h4>
                        </div>
                        <div class="col-lg-6" style="margin:20px 0">
                            <h4>[2] {{$question->choise2}}</h4>
                        </div>

                        <div class="col-lg-6" style="margin:20px 0">
                            <h4>[3] {{$question->choise3}}</h4>
                        </div>
                        <div class="col-lg-6" style="margin:20px 0">
                            <h4>[4] {{$question->choise4}}</h4>
                        </div>
                        <div class="col-lg-8">
                            <form action="{{url('answers/quize/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}
                                <div class="col-lg-4">
                                    <label>Choise Your Number Answer</label>
                                    <select class="form-control" name="answer_choise[]">
                                            <option value="0">......</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="quize_id" value="{{$quize->id}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endif
            <!-- End Choise Text -->

            <!-- Start Choise Image -->
            @if($question->type == "choise_image")
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>{{$question->title}}</h2>
                        </div>

                        <div class="col-lg-12">
                        <img src="{{url('/')}}/uploads/questions/quizes/{{$question->question}}" width="20%">
                        <hr>
                        </div>

                        <div class="col-lg-6">
                            <h4>[1] <img src="{{url('/')}}/uploads/questions/quizes/{{$question->choise1}}" width="30%"> </h4>
                        </div>
                        <div class="col-lg-6">
                            <h4>[2] <img src="{{url('/')}}/uploads/questions/quizes/{{$question->choise2}}" width="30%"></h4>
                        </div>
                        <div class="col-lg-6">
                            <h4>[3] <img src="{{url('/')}}/uploads/questions/quizes/{{$question->choise3}}" width="30%"></h4>
                        </div>
                        <div class="col-lg-6">
                            <h4>[4] <img src="{{url('/')}}/uploads/questions/quizes/{{$question->choise4}}" width="30%"></h4>
                        </div>
                        <div class="col-lg-8">
                        <hr>
                            <form action="{{url('answers/quize/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}
                                <div class="col-lg-4">
                                    <label>Choise Your Number Answer</label>
                                    <select class="form-control" name="answer_choise[]">
                                        <option value="0">......</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="quize_id" value="{{$quize->id}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @endif
            <!-- End choise Image -->
        @endforeach
        <div class="form-group">
            <br>
            <button type="button" class="btn btn-success btn-send">Save Answer</button>
            <button type="submit" class="btn btn-danger">Escape</button>
        </div>
    </section>
    @endif
    <!-- End -->

    <!-- Start -->
    @if($questions->where('type', 'true_false')->isNotEmpty())
    <section>
        @foreach($questions as $question)
                @if($question->type == "true_false")
                <h3 id='true_false' style="color:red">{{$question->time}}</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>{{$question->question}}</h2>
                            </div>

                            <div class="col-lg-12">
                            <form action="{{url('answers/quize/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}

                                <select name="answer_imge_true_false[]" class="form-control" style="width:40%">
                                    <option value="yes"> Yes</option>
                                    <option value="no"> No</option>
                                </select>

                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="quize_id" value="{{$quize->id}}">
                            </form>
                        </div>
                    </div>
                </div>
                @endif
        @endforeach
        <div class="form-group">
            <br>
            <button type="button" class="btn btn-success btn-send">Save Answer</button>
            <button type="submit" class="btn btn-danger">Escape</button>
        </div>
    </section>
    @endif
    <!-- End -->


     <!-- Start -->
     @if($questions->where('type', 'image_true_false')->isNotEmpty())
     <section>
        @foreach($questions as $question)
          <h3 id='time-question-choise' style="color:red">{{$question->time}}</h3>
                @if($question->type == "image_true_false")
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>{{$question->title}}</h2>
                                <img src="{{url('/')}}/uploads/questions/quizes/{{$question->question}}" width="20%">
                            </div>
                            <div class="col-lg-12">
                            <form action="{{url('answers/quize/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}
                                <br>

                                <select name="answer_imge_true_false[]" class="form-control" style="width:40%">
                                    <option value="yes"> Yes</option>
                                    <option value="no"> No</option>
                                </select>


                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="quize_id" value="{{$quize->id}}">
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>

                @endif
        @endforeach
        <div class="form-group">
            <br>
            <button type="button" class="btn btn-success btn-send">Save Answer</button>
            <button type="submit" class="btn btn-danger">Escape</button>
        </div>
    </section>
    @endif
    <!-- End -->


    <!-- Start -->
    @if($questions->where('type', 'text')->isNotEmpty())
    <section>
    @foreach($questions as $question)
      <h3 id='time-question-choise' style="color:red">{{$question->time}}</h3>
            @if($question->type == "text")
                <div class="row">
                    <div class="col-lg-12">
                        <h2>{{$question->question}}</h2>
                    </div>


                    <div class="col-lg-12">
                    <form action="{{url('answers/quize/question/')}}" method="POST" id="questions">
                        {{csrf_field()}}
                        <br>

                        <input type="text" name="answer_text" class="form-control">
                        <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                        <input type="hidden" class="form-control" name="quize_id" value="{{$quize->id}}">
                    </form>
                </div>

            @endif
    @endforeach
    <div class="form-group">
        <br>
        <button type="button" class="btn btn-success btn-send">Save Answer</button>
        <button type="submit" class="btn btn-danger">Escape</button>
    </div>
    </section>
    @endif
    <!-- End -->

@endif


<section class="end-questions">
    <h1 class="alert alert-danger text-center">All Questions Are Over</h1>
</section>
