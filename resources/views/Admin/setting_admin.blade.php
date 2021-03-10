@extends('Admin.index')

@section('title-page')<i class="fas fa-cogs nav-icon"></i> Setting <hr>@endsection

@section('content')


<div class="setting-doctor">
  <div class="container">
                <form action="{{url('admin/setting/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group bmd-form-group">
                                      <label class="bmd-label-floating">title</label>
                                      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{isset($row) ? $row->title:''}}">
                                      @error('title')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group bmd-form-group">
                                      @php $input = 'copyright'; @endphp
                                      <label class="bmd-label-floating">Copyright Link</label>
                                      <input type="text" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" value="{{isset($row) ? $row->{$input}:''}}">
                                      @error($input)
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                            </div>
                            <hr>
                        </div>


                        <div class="row" style="margin-top:20px">
                          <div class="col-lg-4">
                              <div class="row py-4">
                                    <!-- Upload image input-->
                                    <lable class="alert alert-info"> Icon</label>
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0" name="icon">
                                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                        <div class="input-group-append">
                                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                        </div>
                                    </div>
                                    <!-- Uploaded image area-->
                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                              </div>
                          </div>

                          <div class="col-lg-4">
                              <div class="row py-4">
                                    <!-- Upload image input-->
                                    <lable class="alert alert-info"> Logo</label>
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input id="uploadLogo" type="file" onchange="readURLLogo(this);" class="form-control border-0" name="logo">
                                        <label id="upload-label-logo" for="uploadLogo" class="font-weight-light text-muted">Choose file</label>
                                        <div class="input-group-append">
                                            <label for="uploadLogo" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                        </div>
                                    </div>
                                    <!-- Uploaded image area-->
                                    <div class="image-area-logo mt-4"><img id="imageResultLogo" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                              </div>
                          </div>

                          <div class="col-lg-4">
                              <div class="row py-4">
                                    <!-- Upload image input-->
                                    <lable class="alert alert-info"> Background Login </label>
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input id="uploadLogin" type="file" onchange="readURLLogin(this);" class="form-control border-0" name="background_login">
                                        <label id="upload-label-login" for="upload-login" class="font-weight-light text-muted">Choose file</label>
                                        <div class="input-group-append">
                                            <label for="uploadLogin" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                                        </div>
                                    </div>
                                    <!-- Uploaded image area-->
                                    <div class="image-area-login mt-4"><img id="imageResultLogin" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                              </div>
                          </div>

                        </div>


                      <div class="col-md-12">
                          <div class="form-group bmd-form-group text-center">
                            <br>
                              <button type="submit" class="btn btn-success btn-lg"> Update </button>
                          </div>
                      </div>
                    </div>
                </form>
        </div>
  </div>
</div>


@push('js')
<script>
/*  ==========================================
    SHOW UPLOADED IMAGE Logo
* ========================================== */
function readURLLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResultLogo').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#uploadLogo').on('change', function () {
        readURLLogo(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById('uploadLogo');
var infoArea = document.getElementById('upload-label-logo');

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}



/*  ==========================================
    SHOW UPLOADED IMAGE Background Login
* ========================================== */
function readURLLogin(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#imageResultLogin').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $('#uploadLogin').on('change', function () {
        readURLLogin(input);
    });
});

/*  ==========================================
    SHOW UPLOADED IMAGE NAME
* ========================================== */
var input = document.getElementById('uploadLogin');
var infoArea = document.getElementById('upload-label-login');

input.addEventListener( 'change', showFileName );
function showFileName( event ) {
  var input = event.srcElement;
  var fileName = input.files[0].name;
  infoArea.textContent = 'File name: ' + fileName;
}

</script>
@endpush
@endsection
