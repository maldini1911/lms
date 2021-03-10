{{csrf_field()}}

<div class="row">
    <div class="col-md-12">
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

    <!-- Start Faculties -->
    <div class="col-md-12">
        <div class="form-group bmd-form-group ">
            <label class="bmd-label-floating">Fiter Squads By Fauclty</label>
            <select class="form-control" id="filter-squads" data-url="{{url('admin/fiter/squads')}}" name="faculty_id">
                <option> Choise Your Fauclty</option>
                @isset($row)
                  <option value="{{$row->faculty_id}}" selected> {{$row->faculty['name']}}</option>
                  @foreach($faculties as $faculty)
                      @if($faculty->id != $row->faculty_id)
                        <option value="{{$faculty->id}}">  {{$faculty->name}} </option>
                      @endif
                  @endforeach

                @else
                  @foreach($faculties as $faculty)
                        <option value="{{$faculty->id}}">  {{$faculty->name}} </option>
                  @endforeach
                @endisset
            </select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- End Faculties -->

    <!-- Start Terms -->
    <div class="col-md-12" id="squads">
        <div class="form-group bmd-form-group ">
            @php $input = "term_id"; @endphp
            <label class="bmd-label-floating">Squad</label>
            <select name="{{$input}}" class="form-control" id="data">
                @isset($row)
                  @foreach(App\Models\Term::where('faculty_id', $row['faculty_id'])->groupBy('academic_year')->get() as $term)
                    <optgroup label="{{$term->academic_year}}">
                      @foreach(App\Models\Term::where('academic_year', $term->academic_year) as $value)

                          <option value="{{$value['id']}}" selected>{{ $value['term']}}</option>

                        @if($row->term_id != $value->id)
                          <option value="{{$value['id']}}">{{ $value['term']}}</option>
                        @endif

                      <option value="{{$value['id']}}">{{ $value['term']}}</option>

                      @endforeach
                    </optgroup>
                  @endforeach
                @endisset
            </select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- End Terms -->


  <div class="col-md-8">
        <h6 style="font-weight:bolder"> Student Image</h6>
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
                <img src="{{url('/')}}/uploads/students/{{$row->image}}" width="50%">
            @endif
        @endif
  </div>

  <hr>
