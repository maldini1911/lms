{{csrf_field()}}

<div class="row">
    <div class="col-md-6">
        <div class="form-group bmd-form-group">
            @php $input = "doctor_id"; @endphp
            <h4 class="alert alert-info" style="color:#111">{{$doctor->name}} </h4>
            <input type="hidden" name="{{$input}}" value="{{$doctor->id}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <hr>

        <div class="form-group bmd-form-group ">
            @php $input = "course_id[]"; @endphp
            <label class="bmd-label-floating">Add Courses</label>
            <select name="{{$input}}" class="form-control" @isset($row) @else multiple @endisset>
            @isset($row)
            <option value="{{$row->course_id}}" selected> {{$row->course['name']}} </option>
            @endisset
            @foreach($courses as $course)
                <optgroup label="
                @if($course->squad['academic_year'] == 1)
                    {{trans('admin.one_year')}}
                @elseif($course->squad['academic_year'] == 2)
                  {{trans('admin.two_year')}}
                @elseif($course->squad['academic_year'] == 3)
                  {{trans('admin.three_year')}}
                @elseif($course->squad['academic_year'] == 4)
                  {{trans('admin.four_year')}}
                @endif

                @if($course->term_id == Null)
                     - All Year
                @else
                  @if($course->term['term'] == 1)
                       - {{trans('admin.one_term')}}
                  @elseif($course->term['term']  == 2)
                     - {{trans('admin.two_term')}}
                  @endif
                @endif
                ">
                <option value="{{$course->id}}">{{$course['name']}}</option>
                </optgroup>
            @endforeach
            </select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group bmd-form-group">
          <label class="bmd-label-floating">{{trans('admin.academic_year')}}</label>
            @php $input = "academic_year"; @endphp
            <input type="number" class="form-control @error($input) is-invalid @enderror"name="{{$input}}" value="{{isset($row) ? $row->academic_year:''}}">
            @error($input)
                <span class="invalid-feedback" role="alert" >
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
</div>
