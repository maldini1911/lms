{{csrf_field()}}

<div class="row">
    <div class="col-md-8">
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

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "type"; @endphp
            <label class="bmd-label-floating"> Type Course</label>
            <select name="{{$input}}" class="form-control">
                @isset($row)
                    <option value="{{$row->type}}">{{$row->type}}</option>
                @endisset
                <option value="Applied"> Applied </option>
                <option value="Theory">Theory</option>
                <option value="Applied & Theory">Applied & Theory</option>
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
            @php $input = "specialty_id"; @endphp
            <label class="bmd-label-floating">Departments</label>
            <select name="{{$input}}" class="form-control" id="department-filter-squads" data-url="{{url('admin/filter/data')}}">
                @isset($row)
                <option value="{{$row->specialty_id}}"> Choise Department </option>
                @foreach($specialties as $department)
                  @if($row->id == $department->id)
                   <option value="{{$department->id}}" selected> {{$department['name']}}</option>
                   @else
                    <option value="{{$department->id}}"> {{$department['name']}}</option>
                   @endif
                @endforeach

                @else
                    <option> Choise Department </option>
                    @foreach($specialties as $department)
                          <option value="{{$department->id}}"> {{$department['name']}}</option>
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

    <!-- Start Squads -->
    <div class="col-md-8" id="squads-course">
        <div class="form-group bmd-form-group ">
            @php $input = "squad_id"; @endphp
            <label class="bmd-label-floating">Squad</label>
            <select class="form-control @error($input) is-invalid @enderror squads-data" id="department-filter-terms" name="{{$input}}" data-url="{{url('admin/terms/filter/data')}}"></select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- End Squads -->

    <!-- Start Terms -->
    <div class="col-md-8" id="term-course">
        <div class="form-group bmd-form-group ">
            @php $input = "term_id"; @endphp
            <label class="bmd-label-floating">{{trans('admin.term')}}</label>
            <select class="form-control @error($input) is-invalid @enderror" name="term_id" id="terms-data"></select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <!-- End Terms -->

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "theory_hour"; @endphp
            <label class="bmd-label-floating">{{trans("admin.theory_hour")}}</label>
            <input type="number" min="0" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "applied_hour"; @endphp
            <label class="bmd-label-floating">{{trans("admin.applied_hour")}}</label>
            <input type="number" min="0" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "course_goals"; @endphp
            <label class="bmd-label-floating">{{trans("admin.course_goals")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor1">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "educational_goal"; @endphp
            <label class="bmd-label-floating">{{trans("admin.educational_goal")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor1">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "information_concepts"; @endphp
            <label class="bmd-label-floating">{{trans("admin.information_concepts")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor2">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "skills_mindset"; @endphp
            <label class="bmd-label-floating">{{trans("admin.skills_mindset")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor3">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "skills_professional"; @endphp
            <label class="bmd-label-floating">{{trans("admin.skills_professional")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor4">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group bmd-form-group">
            @php $input = "skills_public"; @endphp
            <label class="bmd-label-floating">{{trans("admin.skills_public")}}</label>
            <textarea rows="4" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" id="editor5">
              {{isset($row) ? $row->{$input}:''}}
            </textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

</div>

@push('js')
<script>
  CKEDITOR.replace('editor1');
  CKEDITOR.inline('editor2');
  CKEDITOR.inline('editor3');
  CKEDITOR.inline('editor4');
  CKEDITOR.inline('editor5');
</script>
@endpush
