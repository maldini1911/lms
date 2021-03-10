@extends('Admin.index')
@section('title-page') <i class="fas fa-edit"></i> Edit  @endsection
@section('content')

@component('Admin.shared.edit', ['titlePage' => $titlePage, 'routeName' => $routeName])

<form action="{{route($routeName.'.update', $row->id)}}" method="POST" enctype="multipart/form-data">
    {{method_field('PUT')}}
    @include('Admin.'.$routeName.'.form')
    <button type="submit" class="btn btn-primary" name="action" value="publish"> Publish</button>
    <button type="submit" class="btn btn-info" name="action" value="draft"> Save to draft</button>
    <button type="submit" class="btn btn-danger" name="action" value="scheduling"> Scheduling</button>
    <button type="submit" class="btn btn-info" name="action" value="save_new"> Save & New</button>
</form>


@isset($row)
<hr>
<div class="col-lg-12" style="border-bottom:2px solid #eee;margin:20px 0">
    @if($row->urls->isNotEmpty())
    <h4 style="background:#eee;padding:20px"><i class="fab fa-youtube" style="color:red"></i> URL</h4>
    <div class="row">
        @foreach($row->urls->where('url', '!=', '') as $url)

        <div class="col-lg-3" style="margin:40px 0">
             <iframe width="100%" height="315" src=" {{$url->url}}" allowfullscreen></iframe>
            <form action="{{url('doctors/lessons/url/edit/'.$url->id)}}" method="POST">
                {{csrf_field()}}
                <input type="url" name="url" class="form-control" value="{{$url->url}}" required="required">

                <div style="background:#eee;padding:10px" class="text-center">

                    <button tpye="submit" class="btn btn-success">Edit</button>

                    <a href="{{url('doctors/lessons/url/delete/'.$url->id)}}" class="btn btn-danger"> Delete</a>
                </div>
            </form>


        </div>

        <hr>
        @endforeach

    </div>
    @else
    <h4 class="btn btn-danger">Not Found URL Youtube</h4>
    @endif
</div>
@endisset

@isset($row)
<hr>
<div class="col-lg-12" style="border-bottom:2px solid #eee;margin:20px 0">
    @if($row->videos->isNotEmpty())
    <h4 style="background:#eee;padding:20px"><i class="fas fa-video" style="color:red"></i> Videos</h4>
    <div class="row">
        @foreach($row->videos->where('video', '!=', '') as $video)

        <div class="col-lg-3" style="margin:40px 0">
            <video src="{{url('/')}}/uploads/lessons/videos/{{$video->video}}" width="100%"></video>

            <form action="{{url('doctors/lessons/video/edit/'.$video->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="file" name="video" class="form-control" required="required">
                <div style="background:#eee;padding:10px" class="text-center">
                    <button tpye="submit" class="btn btn-success">Edit</button>
                    <a href="{{url('doctors/lessons/video/delete/'.$video->id)}}" class="btn btn-danger"> Delete</a>
                </div>
            </form>


        </div>
        <hr>
        @endforeach
    </div>
    @else
    <h4 class="btn btn-danger">Not Found Videos</h4>
    @endif
</div>
@endisset

@isset($row)
<hr>
<div class="col-lg-12" style="border-bottom:2px solid #eee;margin:20px 0">

    @if($row->images->isNotEmpty())
    <h4 style="background:#eee;padding:20px"><i class="fas fa-image" style="color:red"></i> Images</h4>
    <div class="row">
        @foreach($row->images->where('image', '!=', '') as $image)

        <div class="col-lg-3" style="margin:40px 0">

            <img src="{{url('/')}}/uploads/lessons/images/{{$image->image}}" width="100%">

            <form action="{{url('doctors/lessons/image/edit/'.$image->id)}}" method="POST" enctype="multipart/form-data">

                {{csrf_field()}}
                <input type="file" name="image" class="form-control" required="required">
                 <div style="background:#eee;padding:10px" class="text-center">
                    <button tpye="submit" class="btn btn-success">Edit</button>
                    <a href="{{url('doctors/lessons/image/delete/'.$image->id)}}" class="btn btn-danger"> Delete</a>
                </div>
            </form>


        </div>
        <hr>
        @endforeach
    </div>
    @else
    <h4 class="btn btn-danger">Not Found Images</h4>
    @endif
</div>
@endisset

@isset($row)
<hr>
   <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <h5>Lesson Attachment</h5>
                              @if($row->attachments->isNotempty())
                            <div class="table-responsive">
                                <table id="courses" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>file Name </th>
                                            <th>Show</th>
                                            <th>Action</th>
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

                                                 <td>
                                                     <a class="btn btn-success btn-md"  href="{{url('doctors/attachment/view/edit/'.$attachment->id)}}" class="link-edit btn"> Edit </a>
                                                     <a class="btn btn-danger btn-md"  href="{{url('doctors/attachment/delete/'.$attachment->id)}}" class="link-delete btn"> Delete </a>
                                                 </td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h4 class="alert alert-danger">Not Found Files PDF OR DOXC </h4>
                            @endif
                          </div>
                        </div>
                    </div>

@endisset


@endcomponent
@endsection
