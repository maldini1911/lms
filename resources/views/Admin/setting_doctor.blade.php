@extends('Admin.index')

@section('title-page')<i class="fas fa-cogs nav-icon"></i> Setting @endsection

@section('content')


<div class="setting-doctor">
  <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">{{trans('admin.position')}}</label>
                        <input type="text" class="form-control" value="{{$row->role}}" disabled>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">{{trans('admin.name')}}</label>
                        <input type="text" class="form-control" value="{{$row->name}}" disabled>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating">{{trans('admin.starting_work')}}</label>
                        <input type="text" class="form-control" value="{{$row->work_start}}" disabled>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <div class="form-group bmd-form-group">
                      @if(auth()->guard('doctor')->user()->image != null)
                      <img src="{{url('/')}}/uploads/doctors/{{auth()->guard('doctor')->user()->image}}" class="img-circle" alt="">
                      @endif
                    </div>
                </div>

            </div>


            <div class="col-md-6">
            <form action="{{url('doctors/setting/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                       <div class="row">
                            {!! csrf_field() !!}

                                  <div class="col-md-12">
                                      <div class="form-group bmd-form-group">
                                          @php $input = 'mobile'; @endphp
                                          <label class="bmd-label-floating">{{trans("admin.mobile")}}</label>
                                          <input type="text" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" value="{{isset($row) ? $row->{$input}:''}}">
                                          @error($input)
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-12">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">{{trans("admin.email")}}</label>
                                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{isset($row) ? $row->email:''}}">
                                          @error('email')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-md-12">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">{{trans("admin.password")}}</label>
                                          <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                          @error('password')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                      </div>
                                  </div>

                                  <div class="col-lg-12 text-center">
                                      <div class="row py-12">
                                        <div class="col-lg-12 mx-auto">


                                            <!-- Upload image input-->
                                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="image">
                                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                                <div class="input-group-append">
                                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                                </div>
                                            </div>

                                            <!-- Uploaded image area-->
                                            <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                            </div>



                          <div class="col-md-12">
                              <div class="form-group bmd-form-group text-center">
                                  <button type="submit" class="btn btn-success btn-lg"> Save </button>
                              </div>
                          </div>

                        </div>
                    </form>
            </div>
          </div>
      </div>
  </div>




@endsection
