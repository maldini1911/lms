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
                        <div class="col-lg-6">
                            <div class="session-box">
                                <div class="card">
                                    <div class="card-body">
                                        @if($row->show_media == 'image')
                                            @if($row->lesson_image != null)
                                            <img src="{{url('/')}}/uploads/lessons/images/{{$row->lesson_image}}" width="100%">
                                            @else
                                            <h4 class="alert alert-danger text-center"> Not Found Image</4>
                                            @endif
                                        @endif

                                        @if($row->show_media == 'video')
                                            @if($row->lesson_video != null)
                                            <video src="{{url('/')}}/uploads/lessons/videos/{{$row->lesson_video}}" width="100%"> </video>
                                            @else
                                            <h4 class="alert alert-danger text-center"> Not Found Video </4>
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


            @if($row->urls->isNotEmpty())
                <hr>
                <h4> <i class="fab fa-youtube" style="color:red"></i> Url YouTube</h4>
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

            @if($row->images->isNotEmpty())
                <hr>
                <h4> <i class="fas fa-image" style="color:red"></i> Images</h4>
                <div class="row">
                        @foreach($row->images as $image)
                            @if($image->image != '')
                            <div class="col-lg-4">
                                <div class="session-box">
                                    <div class="card">
                                        <div class="card-body">
                                        <img src="{{url('/')}}/uploads/lessons/images/{{$image->image}}" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                </div>
            @endif

            <hr>
            <div class="row">
                  @if($row->lecture != null)
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lectures</h5>
                                <a href="{{url('doctors/lectures/view/'.$row->lecture->id)}}" class="card-link" style="display:block;margin-left:20px">{{$row->lecture->title}}</a>
                          </div>
                        </div>
                    </div>
                  @endif

                  <!-- Start Interactive Session -->
                  @if($interactive_session != null)
                  <div class="col-lg-3">
                      <div class="card">
                        <div class="card-body">
                          <h5>Interactive Sessions Lesson</h5>
                              <a href="{{$interactive_session->url_session}}" class="card-link" style="display:block;margin-left:20px" target="_blank">Link Interactive Session</a>
                        </div>
                      </div>
                  </div>
                  @endif
                  <!-- End Interactive Session -->
                  @if($assignments->isNotEmpty())
                  <div class="col-lg-3">
                      <div class="card">
                        <div class="card-body">
                          <h5>Lesson Assignment</h5>
                              @foreach($assignments as $assignment)
                              <a href="{{url('doctors/assignments/'.$assignment->id)}}" class="card-link" style="display:block;margin-left:20px">{{$assignment->code_assignment}}</a>
                              @endforeach
                        </div>
                      </div>
                  </div>
                  @endif

                  @if($quizes->isNotempty())
                    <div class="col-lg-3">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lesson Quize</h5>
                                @foreach($quizes as $quize)
                                <a href="{{url('doctors/quizes/'.$quize->id)}}" class="card-link" style="display:block;margin-left:20px">{{ $quize->code_quize}}</a>
                                @endforeach
                          </div>
                        </div>
                    </div>
                  @endif

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
                                                      <a href="{{url('doctors/lessons/attachment/'.$attachment->id)}}" class="card-link" style="display:block;margin-left:20px"> Show</a>
                                                     @endif

                                                     @if($attachment->file_type == "docx")
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
                      @endif
                </div>
          </div>
          <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection
