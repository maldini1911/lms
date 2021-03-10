@if($questions->isNotEmpty())

  <!-- Start -->
  @if($questions->where('type', 'choise_text')->isNotEmpty() OR $questions->where('type', 'choise_image_text')->isNotEmpty())
    <section>
      @foreach($questions  as $question)

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
                            <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}
                                <hr>
                                <div class="col-lg-6">
                                    <select class="form-control" name="choise_text[]">
                                            <option value="0">Choise Answer</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                    <hr>
                                    <p class="alert alert-success text-center" id="message-send-answer">  Send Your Answer Successfully </p>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
                <hr>
          @endif
          <!-- End Choise Text -->

          <!-- Start Choise Text And Image -->
          @if($question->type == "choise_image")
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>{{$question->question}}</h2>
                    <hr>
                    </div>
                    <div class="col-lg-6">
                        <h4>[1] <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise1}}" width="30%"> </h4>
                    </div>
                    <div class="col-lg-6">
                        <h4>[2] <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise2}}" width="30%"></h4>
                    </div>
                    <div class="col-lg-6">
                        <h4>[3] <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise3}}" width="30%"></h4>
                    </div>
                    <div class="col-lg-6">
                        <h4>[4] <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise4}}" width="30%"></h4>
                    </div>
                    <div class="col-lg-8">
                        <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                            {{csrf_field()}}
                            <hr>
                            <div class="col-lg-6">
                                <select class="form-control" name="choise_image[]">
                                        <option value="0">Choise Answer</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                </select>
                            </div>
                            <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                            <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                            <div class="form-group">
                                <br>
                                <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                <hr>
                                <p class="alert alert-success text-center" id="message-send-answer">  Send Your Answer Successfully </p>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <hr>
          @endif
          <!-- End Choise Text  And Image -->


          <!-- Start Choise Image And Text -->
          @if($question->type == "choise_image_text")
                <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12">
                          <img src="{{url('/')}}/uploads/questions/assignments/{{$question->choise1}}" width="30%">
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
                            <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                                {{csrf_field()}}
                                <hr>
                                <div class="col-lg-6">
                                    <select class="form-control" name="choise_image_text[]">
                                            <option value="0">Choise Answer</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                                <div class="form-group">
                                    <br>
                                    <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
                <hr>
          @endif
          <!-- End Choise Image And Text-->

      @endforeach
  </section>
  @endif
  <!-- End -->

  <!-- Start -->
  @if($questions->where('type', 'true_false')->isNotEmpty())
    <section class="true_false">
      @foreach($questions as $question)
          @if($question->type == "true_false")
              <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <h2>{{$question->question}}</h2>
                      </div>
                      <div class="col-lg-12">
                        <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                            {{csrf_field()}}

                            <select name="answer_imge_true_false[]" class="form-control" style="width:40%">
                                <option value="yes"> Yes</option>
                                <option value="no"> No</option>
                            </select>

                            <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                            <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                            <div class="form-group">
                                <br>
                                <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                <br>
                                <button type="button" class="btn btn-success btn-send">Save Answer</button>
                            </div>
                        </form>
                      </div>
                  </div>
                  </div>
              </div>
              <hr>
          @endif
      @endforeach
  </section>
  @endif
  <!-- End -->

 <!-- Start -->
   @if($questions->where('type', 'image_true_false')->isNotEmpty())
     <section class="image-true-false">
        @foreach($questions as $question)
                @if($question->type == "image_true_false")
                  <div class="card">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-lg-12">
                                      <h2>{{$question->title}}</h2>
                                      <img src="{{url('/')}}/uploads/questions/assignments/{{$question->question}}" width="40%">
                                  </div>
                                  <div class="col-lg-12">
                                  <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                                      {{csrf_field()}}
                                      <br>

                                      <select name="answer_imge_true_false[]" class="form-control" style="width:40%">
                                          <option value="yes"> Yes</option>
                                          <option value="no"> No</option>
                                      </select>

                                      <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                                      <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                                      <div class="form-group">
                                          <br>
                                          <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                          <br>
                                          <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                @endif
        @endforeach
     </section>
   @endif
  <!-- End -->


  <!-- Start -->
  @if($questions->where('type', 'text')->isNotEmpty())
    <section>
      @foreach($questions as $question)
              @if($question->type == "text")
              <div class="card">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-lg-12">
                              <h2>{{$question->question}}</h2>
                          </div>

                          <div class="col-lg-12">
                          <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions">
                              {{csrf_field()}}
                              <br>
                              <input type="text" name="answer_text" class="form-control">
                              <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                              <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">
                              <div class="form-group">
                                  <br>
                                  <button type="button" class="btn btn-success btn-send">Save Answer</button>
                                  <br>
                                  <button type="button" class="btn btn-success btn-send">Save Answer</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              @endif
      @endforeach
    </section>
  @endif
  <!-- End -->


  <!-- Start -->
  @if($questions->where('type', 'edit_image')->isNotEmpty())
    <section>
      @foreach($questions as $question)
              @if($question->type == "edit_image")
              <div class="card">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{$question->title}} </label>
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
                              </div>
                              <hr>

                          </div>

                          <div class="col-lg-12">
                          <form action="{{url('answers/assignment/question/')}}" method="POST" id="questions" enctype="multipart/form-data" multiple="multiple">
                              {{csrf_field()}}
                              <br>

                              <input type="file" class="form-control" name="question_edit_image[]" multiple="multiple">
                              <input type="hidden" class="form-control" name="id[]" value="{{$question->id}}">
                              <input type="hidden" class="form-control" name="assignment_id" value="{{$assignment->id}}">

                              <div class="form-group">
                                  <br>
                                  <button type="submit" class="btn btn-success btn-send">Save Answer</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              @endif
      @endforeach
    </section>
  @endif
  <!-- End -->



    <!-- Start Message After Show All Questions -->
    <section class="end-questions">
        <h3 class="alert alert-danger text-center" style="color:#111">All Questions Finish</h3>
    </section>
    <!-- End Message After Show All Questions -->
@endif
