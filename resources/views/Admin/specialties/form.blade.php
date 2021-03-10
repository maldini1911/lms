{{csrf_field()}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            @php $input = "name"; @endphp
            <label class="bmd-label-floating">{{trans("admin.name")}}</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
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
            <label class="bmd-label-floating">{{trans('admin.faculty_name')}}</label>
            <select class="form-control" name="faculty_id">
              @isset($row)
                      <option value="{{$row->faculty_id}}" selected>  {{$row->faculty['name']}}</option>
                      @foreach($faculties as $faculty)
                      @if($faculty->id == $row->faculty_id)
                        @else
                          <option value="{{$faculty->id}}">  {{$faculty->name}} </option>
                      @endif

                      @endforeach
              @else
                  <option> Choise Fiter Squad.............</option>
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


    <!-- End Terms -->

    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            @php $input = "years"; @endphp
            <label class="bmd-label-floating">{{trans('admin.academic_year')}}</label>
            <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
                 <option value="1" @isset($row)  @if($row->years == 1)  ? selected : '' @endif @endisset> {{trans('admin.one_year')}} </option>
                 <option value="2" @isset($row)  @if($row->years == 2)  ? selected : '' @endif @endisset> {{trans('admin.two_year')}} </option>
                 <option value="3" @isset($row)  @if($row->years == 3)  ? selected : '' @endif @endisset> {{trans('admin.three_year')}} </option>
                 <option value="4" @isset($row)  @if($row->years == 4)  ? selected : '' @endif @endisset> {{trans('admin.four_year')}} </option>
                 <option value="5" @isset($row)  @if($row->years == 5)  ? selected : '' @endif @endisset> {{trans('admin.five_year')}} </option>
            </select>

            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>
