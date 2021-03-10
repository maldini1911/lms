@extends('Admin.index')



@section('content')
<div class="row" style="overflow:hidden">
  <div class="col-md-12">
    <div class="card">
          <div class="card-header">
            <h4> <i class="fas fa-books"></i> {{$row->title}} </h4>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if($row->content != null)
                <div class="row">
                        <div class="col-lg-4">
                            <div class="session-box">
                                <div class="card" style="min-height:235px">
                                    <div class="card-body">
                                        @if($row->show_media == 'image')
                                            @if($row->lesson_image != null)
                                            <img src="{{url('/')}}/uploads/lessons/images/{{$row->lesson_image}}" width="100%">
                                            @else
                                            <h4 class="alert alert-danger text-center"> Not Found Image</h4>
                                            @endif
                                        @endif

                                        @if($row->show_media == 'video')
                                            @if($row->lesson_video != null)
                                            <video src="{{url('/')}}/uploads/lessons/videos/{{$row->lesson_video}}" width="100%"> </video>
                                            @else
                                            <h4 class="alert alert-danger text-center"> Not Found Video</h4>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="session-box">
                                <div class="card" style="min-height:235px">
                                    <div class="card-body">
                                      <h4> Lesson Description</h4>
                                      <hr>
                                        {{$row->content}}

                                </div>
                            </div>
                        </div>
                </div>
            @endif
          </div>


              <!-- Start URLs -->
              @if($row->urls->isNotEmpty())
                  <hr>
                  <h4> <i class="fab fa-youtube" style="color:red"></i> URL YouTube</h4>
                  <div class="row">
                    @foreach($row->urls as $url)
                        @if($url->url != '')
                        <div class="col-lg-4">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                        <iframe width="100%" height="315" src=" {{$url->url}}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                  </div>
               @endif
               <!-- End URLs -->

               <!-- Start Videos -->
                 @if($row->videos->isNotEmpty())
                  <hr>
                  <h4> <i class="fas fa-video" style="color:red"></i> Videos </h4>
                  <div class="row">
                          @foreach($row->videos as $video)
                              @if($video->video != '')
                              <div class="col-lg-4">
                                  <div class="session-box">
                                      <div class="card">
                                          <div class="card-body">
                                          <video src="{{url('/')}}/uploads/lessons/videos/{{$video->video}}" width="100%"> </video>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              @endif
                          @endforeach
                  </div>
                 @endif
                <!-- End Videos -->

                <!-- Start Images -->
                @if($row->images->isNotEmpty())
                  <h4> <i class="fas fa-photo" style="color:red"></i> Images </h4>
                  <div class="row">
                        @foreach($row->images->where('image', '!-', '') as $image)
                            @if($image->image != null)
                            <div class="col-lg-4">
                                <div class="session-box">
                                    <div class="card">
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


                <div class="row">
                  <!-- Start Lecture -->
                   @if($row->lecture != null)
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lectures</h5>
                                <a href="{{url('details/lecture/'.$row->lecture->id)}}" class="card-link" style="display:block;margin-left:20px">{{$row->lecture->title}}</a>
                          </div>
                        </div>
                    </div>
                    @endif

                    <!-- Start Interactive Session -->
                    @if($interactive_session != null)
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Interactive Sessions </h5>
                                <a href="{{$interactive_session->url_session}}" class="card-link" style="display:block;margin-left:20px" target="_blank">Link Interactive Session</a>
                          </div>
                        </div>
                    </div>
                    @endif
                    <!-- End Interactive Session -->

                    <!-- Start Assignment -->
                    @if($assignments->isNotEmpty())
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lesson Assignment</h5>
                                @foreach($assignments as $assignment)
                                <a href="{{url('admin/assignments/'.$assignment->id)}}" class="card-link" style="display:block;margin-left:20px">{{$assignment->code_assignment}}</a>
                                @endforeach
                          </div>
                        </div>
                    </div>
                    @endif
                    <!-- End Assignment -->

                    <!-- Start Quizes -->
                    @if($quizes->isNotEmpty())
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lesson Quize</h5>
                                @foreach($quizes as $quize)
                                <a href="{{url('admin/quizes/'.$quize->id)}}" class="card-link" style="display:block;margin-left:20px">{{ $quize->code_quize}}</a>
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
                            <h5>Lesson Attachment</h5>
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
                                                      <a href="{{url('attachment/'.$attachment->id)}}" class="card-link btn btn-info btn-md" style="display:block;margin-left:20px"> Show</a>
                                                     @endif

                                                     @if($attachment->file_type == "docx")
                                                     <a href="{{url('/')}}/uploads/attachments/{{$attachment->file_name}}" class="card-link btn btn-info btn-md" style="display:block;margin-left:20px"> Show</a>
                                                     @endif
                                                 </td>


                                                 </td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>

                          </div>
                        </div>
                    </div>
                  </div>
                  @endif
                  <!-- End Attachments -->


            </div>
          </div>
          <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection
