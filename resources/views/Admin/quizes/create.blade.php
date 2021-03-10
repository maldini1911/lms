@extends('Admin.index')

@section('title-page') <i class="fas fa-plus"></i>  Create New Quize @endsection

@section('content')
<div class="content quizes">
    <section class="content">
        <div class="container-fluid">
            <div class="card-body">
                <!-- Start Questions -->
                <div class="questions">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{url('doctors/quizes/store')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <h4> <i class="fas fa-street-view"></i> Show Questions </h4>
                                    <div class="row">
                                        <div class="col-lg-6" >
                                            <div class="quize-bar" style="background:#eee;padding:20px;border-radius:4px">
                                                    <div class="form-group bmd-form-group">
                                                        @php $input = "course_id"; @endphp
                                                        <label class="bmd-label-floating" style="color:#111">Course</label>
                                                        <select name="{{$input}}" class="form-control">
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
                                                    @php $input = "code_quize"; @endphp
                                                    <label class="bmd-label-floating" style="color:#111">Quize Code </label>
                                                    <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}" required="required">
                                                    @error($input)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    @php $input = "name_quize"; @endphp
                                                    <label class="bmd-label-floating" style="color:#111">Quize Name </label>
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
                                                 <label>{{trans('admin.start_scheduling')}}</label>
                                                 <input type="text" name="start_scheduling" class="form-control" id="datetimepicker" autocomplete="off">
                                                 <hr>
                                                 <label>{{trans('admin.finish_scheduling')}}</label>
                                                 <input type="text" name="finish_scheduling" class="form-control" id="datetimepicker2" autocomplete="off">
                                                 <hr>
                                               </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" style="color:#111">Total Mark</label>
                                                    <input type="text" class="form-control" >
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" style="color:#111">Number Of Questions</label>
                                                    <input type="text" class="form-control" >
                                                </div>


                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1" style="color:#111">Total Time</label>
                                                      <input type="number" class="form-control" name="full_time">
                                                  </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- #### -->
                                            <div class="section-text-que">
                                                <div class="form-group mark-time">
                                                    <label for="exampleFormControlInput1">Mark</label></label>
                                                    <input type="text" class="form-control" name="mark_text" style="width:200px" placeholder="Mark">
                                                    <label for="exampleFormControlInput1">Time</label></label>
                                                    <input type="text" class="form-control" name="time_text" style="width:200px" placeholder="Minutes">
                                                </div>
                                            </div>


                                            <div class="section-choice-que">
                                                <div class="form-group mark-time">
                                                    <label for="exampleFormControlInput1">Mark</label></label>
                                                    <input type="text" class="form-control" name="mark_choise" style="width:200px" placeholder="Mark">
                                                    <label for="exampleFormControlInput1">Time</label></label>
                                                    <input type="text" class="form-control" name="time_choise" style="width:200px" placeholder="Minutes">
                                                </div>
                                            </div>

                                            <div class="section-img-que">
                                                <div class="form-group mark-time">
                                                    <label for="exampleFormControlInput1">Mark</label></label>
                                                    <input type="text" class="form-control" name="mark_file_correct" style="width:200px" placeholder="Mark">
                                                    <label for="exampleFormControlInput1">Time</label></label>
                                                    <input type="text" class="form-control" name="time_file_correct" style="width:200px" placeholder="Minutes">
                                                </div>
                                            </div>


                                            <div class="section-true-false">
                                                <div class="form-group mark-time">
                                                        <label for="exampleFormControlInput1">Mark</label></label>
                                                        <input type="text" class="form-control" name="mark_correct" style="width:200px" placeholder="Mark">
                                                        <label for="exampleFormControlInput1">Time</label></label>
                                                        <input type="text" class="form-control" name="time_correct" style="width:200px" placeholder="Minutes">
                                                </div>
                                            </div>


                                            <div class="section-edit-image">
                                                <div class="form-group mark-time">
                                                    <label for="exampleFormControlInput1">Mark</label></label>
                                                    <input type="number" class="form-control" name="mark_edit_image" style="width:200px" placeholder="Mark">
                                                    <label for="exampleFormControlInput1">Time</label></label>
                                                    <input type="number" class="form-control" name="time_edit_image" style="width:200px" placeholder="Minutes">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="type-questions">
                                        <div class="row">
                                            <div class="col-lg-3 col-xs-12">
                                                 <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>
                                            </div>
                                            <div class="col-lg-3 col-xs-12">
                                                <button type="submit" class="btn btn-info" name="action" value="save"> Save As Draft</button>
                                            </div>
                                            <div class="col-lg-3 col-xs-12">
                                                <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Schedule</button>
                                            </div>

                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                </div>
                <!-- End Questions -->
                <hr>
                <h4><i class="fas fa-pen-alt"></i> Choose the question type:</h4>
                <hr>
                <div class="type-questions">
                  <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <button class="btn btn-md btn-primary text-que"><i class="fas fa-plus"></i> Text question</button>
                            <button class="btn btn-md btn-primary choice-que"><i class="fas fa-plus"></i>  Multiple-choice</button>
                            <button class="btn btn-md btn-primary img-que"><i class="fas fa-plus"></i> File Image</button>
                            <button class="btn btn-md btn-primary true-false"><i class="fas fa-plus"></i> True or Flase</button>
                            <button class="btn btn-md btn-primary edit-image"><i class="fas fa-plus"></i> Edit Image</button>
                        </div>
                      </div>
                  </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-4">
                          <form action="{{url('doctors/questions/bulck')}}" method="POST" enctype="multipart/form-data">
                              {{csrf_field()}}
                              <input type="file" class="form-control" name="questions" required="required">
                              <button class="btn btn-md btn-success" type="submit"><i class="fas fa-check-circle"></i> Bluck Uploade </button>
                          </form>
                      </div>
                      <div class="col-lg-4">
                          <a href="{{url('/')}}/uploads/attachments/questions.xlsx" class="card-link btn btn-info">  Download Sample </a>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
