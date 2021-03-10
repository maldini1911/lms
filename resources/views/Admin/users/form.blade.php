{{csrf_field()}}

<div class="row">
    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">{{trans("admin.name")}}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($row) ? $row->name:''}}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
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

    <div class="col-md-8">
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

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Permissions</label>
            <select name="role" class="form-control">
                @isset($row)
                <option value="{{$row->role}}">{{ucfirst($row->role)}}</option>
                @endisset
                <option value="manger">Admin</option>
                <option disabled>Editor</option>
                <option disabled>Human resource</option>
                <option disabled>Finance</option>
                <option disabled>Students affaires</option>
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
          <h6 style="font-weight:bolder"> Admin Image</h6>
          <div class="row py-8">
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

    <div class="col-lg-4 text-center">
          @isset($row)
              @if($row->image != null)
                  <img src="{{url('/')}}/uploads/admin/{{$row->image}}" width="50%">
              @endif
          @endif
    </div>
</div>
<hr>
