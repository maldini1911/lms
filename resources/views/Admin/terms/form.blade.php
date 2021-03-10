{{csrf_field()}}

<div class="row">

  <div class="col-md-8">
      <div class="form-group bmd-form-group">
          @php $input = "faculty_id"; @endphp
          <label class="bmd-label-floating">{{trans("admin.faculty_name")}}</label>
          <select name="{{$input}}" class="form-control">
              @isset($row)
                  <option value="{{$row->faculty_id}}">{{$row->faculty->name}}</option>
              @endisset
              @foreach($faculties as $faculty)
                  <option value="{{$faculty->id}}">{{$faculty->name}}</option>
              @endforeach
          </select>
          @error($input)
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>
    </div>


    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "academic_year"; @endphp
            <label class="bmd-label-floating">Squad</label>
            <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
                @isset($row)
                  <option value="{{$row->term['id']}}" selected>
                  @include('Admin.terms.show_years')
                 </option>
                 @endisset
                 <option value="1"> {{trans('admin.one_year')}} </option>
                 <option value="2"> {{trans('admin.two_year')}} </option>
                 <option value="3"> {{trans('admin.three_year')}} </option>
                 <option value="4"> {{trans('admin.foure_year')}} </option>
                <option value="5"> {{trans('admin.five_year')}} </option>
            </select>

            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <!-- <div class="col-md-8">
          <div class="form-group bmd-form-group">
              @php $input = "term[]"; @endphp
              <label class="bmd-label-floating">{{trans("admin.term")}}</label>
              <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}" multiple="multiple">
                  <option value="1"> {{trans("admin.one_term")}}</option>
                  <option value="2"> {{trans("admin.two_term")}}</option>
              </select>
              @error($input)
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
    </div> -->

</div>
<hr>
