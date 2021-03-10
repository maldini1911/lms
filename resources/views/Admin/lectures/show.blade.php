@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> {{$row->title}} @endsection

@section('content')
<div class="row" style="overflow:hidden">
  <div class="col-md-12">
    <div class="card">
          <div class="card-header">
            {{$row->title}}
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if($row->content != null)
                <div class="row">
                        <div class="col-lg-6">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                        @if($row->show_media == 'image')
                                            @if($row->lecture_image != null)
                                            <img src="{{url('/')}}/uploads/lectures/images/{{$row->lecture_image}}" width="100%">
                                            @else
                                            <h4 class="alert alert-danger"> Not Found Image </h4>
                                            @endif
                                        @endif

                                        @if($row->show_media == 'video')
                                            @if($row->lecture_video != null)
                                            <video src="{{url('/')}}/uploads/lectures/videos/{{$row->lecture_video}}" width="100%"> </video>
                                            @else
                                            <h4 class="alert alert-danger"> Not Found Video </h4>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                    <p class="card-text" style="height:100%;line-height:2.2">
                                        {{$row->content}}
                                    </p>

                                </div>
                            </div>
                        </div>
                </div>
            @endif
          </div>

          <!-- Start URLs -->
          @if($row->urls->isNotEmpty())
            <hr>
            <h4> <i class="fab fa-youtube" style="color:red"></i> Url YouTube</h4>
            <div class="row">
                    @foreach($row->urls->where('url', '!=', '') as $url)
                        <div class="col-lg-4 col-4">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                        <iframe width="100%" height="315" src=" {{$url->url}}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
          @endif
          <!-- End URLs -->

          <!-- Start Videos -->
          @if($row->videos->isNotEmpty())
            <hr>
             <h4> <i class="fas fa-video" style="color:red"></i> Videos</h4>
            <div class="row">

                    @foreach($row->videos->where('video', '!=', '') as $video)
                        <div class="col-lg-4 col-4">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                       <video src="{{url('/')}}/uploads/lectures/videos/{{$video->video}}" width="100%"></video>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
            </div>
          @endif
          <!-- end Videos -->

          <!-- Start Images -->
          @if($row->images->isNotEmpty())
            <hr>
            <h4> <i class="fas fa-photo" style="color:red"></i> Images </h4>
            <div class="row">
                    @foreach($row->images->where('image', '!=', '') as $image)
                        @if($image->image != null)
                        <div class="col-lg-4 col-4">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                    <img src="{{url('/')}}/uploads/lectures/images/{{$image->image}}" width="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
            </div>
          @endif
          <!-- End Images -->

          <!-- Start Lesson -->
          @if($row->lessons->isNotempty())
            <hr>
            <h4>Lessons</h4>
            <div class="row text-center">
                @foreach($row->lessons as $lesson)
                    <div class="col-lg-4">
                        <div class="card" style="background:#eee">
                        <img src="{{url('/')}}/uploads/lessons/images/{{$lesson->lesson_image}}" width="100%">
                        <div class="card-body">
                            <h2 style="background:#f2f2f2;padding:10px">{{$lesson->title}}</h2>
                            <h5 style="background:#f2f2f2;padding:10px">{{$lesson->desc}}</h5>
                            <a href="{{url('doctors/lessons/'.$lesson->id)}}" class="card-link" style="display:block;background:#f2f2f2;padding:10px;font-size:20px">Go Lesson</a>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
          @endif
          <!-- End Lessons -->

          <div class="row">
            <!-- Start Interactive Session -->
            @if($interactive_session != null)
            <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <h5>Interactive Sessions</h5>
                        <a href="{{$interactive_session->url_session}}" class="card-link" style="display:block;margin-left:20px" target="_blank">Link Interactive Session</a>
                  </div>
                </div>
            </div>
            @endif
            <!-- End Interactive Session -->

              <!-- Start Aissgnment -->
              @if($assignments->isNotEmpty())
                <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <h5>Lecture Assignment</h5>
                            @foreach($assignments as $assignment)
                            <a href="{{url('doctors/assignments/'.$assignment->id)}}" class="card-link" style="display:block;margin-left:20px">{{$assignment->code_assignment}}</a>
                            @endforeach
                      </div>
                    </div>
                </div>
              @endif
              <!-- End Assignment -->

              <!-- Start Quizes -->
              @if($quizes->isNotEmpty())
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <h5>Lecture Quize</h5>
                          @foreach($quizes as $quize)
                          <a href="{{url('doctors/quizes/'.$quize->id)}}" class="card-link" style="display:block;margin-left:20px">{{ $quize->code_quize}}</a>
                          @endforeach
                    </div>
                  </div>
              </div>
              @endif
              <!-- End Quizes -->

              <!-- Start Attachments -->
            @if($row->attachments->isNotempty())
            <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lecture Attachment</h5>
                            <div class="table-responsive">
                                <table id="courses" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>file Name </th>
                                            <th>Show</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($row->attachments as $attachment)
                                            <tr>
                                                <td> {{$attachment->file_name}}</td>
                                                 <td>
                                                     @if($attachment->file_type == "pdf")
                                                      <a href="{{url('doctors/lectures/attachment/'.$attachment->id)}}" class="card-link" style="display:block;margin-left:20px"> Show</a>
                                                     @endif

                                                     @if($attachment->file_type == "docx" OR $attachment->file_type == "others")
                                                     <a href="{{url('/')}}/uploads/attachments/{{$attachment->file_name}}" class="card-link" style="display:block;margin-left:20px"> Show</a>
                                                     @endif
                                                 </td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- End Attachment -->
                </div>
            </div>
            @endif
            <!-- End Attachments -->
          <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection
