{{csrf_field()}}

 <div class="col-6">
        <div class="form-group bmd-form-group ">
            @php $input = "course_id"; @endphp
            <label class="bmd-label-floating">Course</label>
            <select name="{{$input}}" class="form-control">
                @isset($row)
                    <option value="{{$row->course['id']}}"> {{$row->course['name']}} </option>
                @endisset
                @foreach($courses as $course)
                <option value="{{$course->course['id']}}"> {{$course->course['name']}} </option>
                @endforeach
            </select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group bmd-form-group">
            @php $input = "title"; @endphp
            <label class="bmd-label-floating">{{trans("admin.title")}}</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

         <div class="form-group bmd-form-group">
            @php $input = "desc"; @endphp
            <label class="bmd-label-floating">Description</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group bmd-form-group">
            @php $input = "content"; @endphp
            <label class="bmd-label-floating"> Content Text </label>
            <textarea class="form-control @error($input) is-invalid @enderror" name="{{$input}}" rows="10">{{isset($row) ? $row->{$input}:''}}</textarea>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <hr>

        <div class="form-group bmd-form-group">
            @php $input = "url_session"; @endphp
            <label class="bmd-label-floating">URL {{trans('admin.interactive_sessions')}}</label>
            @isset($row)
              @if($row->interactive_sessions_lecture->isNotEmpty())
                @foreach($row->interactive_sessions_lecture as $session)
                  @php $interactive_session_lecture = $session->url_session @endphp
                @endforeach

                @else
                @php $interactive_session_lecture = '' @endphp
              @endif
            @endisset
            <input type="text" class="form-control" name="{{$input}}" value="{{isset($row) ?  $interactive_session_lecture  :''}}">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group bmd-form-group ">
            @php $input = "file_type"; @endphp
            <label class="bmd-label-floating">Attachment Type</label>
            <select name="{{$input}}" class="form-control">
                <option>Choise Attachment Type</option>
                <option value="pdf"> PDF </option>
                <option value="docx"> DOCX </option>
                <option value="others"> Others </option>
            </select>
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group bmd-form-group">
            @php $input = "file_name"; @endphp
            <label class="bmd-label-floating">Attachment File</label>
            <input type="file" class="form-control" name="{{$input}}" accept=".docx, .pdf">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


</div>

<div class="col-6">

  <div class="form-group bmd-form-group ">
      @php $input = "show_media"; @endphp
      <label class="bmd-label-floating">Thumbnail Type</label>
      <select name="{{$input}}" class="form-control" id="type-media">
          @isset($row)
          <option value="{{$row->show_media}}">{{$row->show_media}}</option>
          @endisset
          <option> Choise Your Type Show</option>
          <option value="image"> Image </option>
          <option value="video"> Video </option>
      </select>
      @error($input)
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <div class="form-group video-type">
      @php $input = 'lecture_video'; @endphp
        <label for="exampleInputEmail1">Thumbnail Video </label>
        <input type="file" name="lecture_video" class="form-control">
        <hr>
    </div>

    <div class="form-group image-type">
         @php $input = 'lecture_image'; @endphp
        <label for="exampleInputEmail1">Thumbnail Image </label>
        <input type="file" name="lecture_image" class="form-control">
        <hr>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Content videos</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="video[]" multiple>
                <label class="custom-file-label" for="exampleInputFile">Upload Image/Video</label>
            </div>
            <hr>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Content Images</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image[]" multiple>
                <label class="custom-file-label" for="exampleInputFile">Upload Image/Video</label>
            </div>
            <hr>
        </div>
    </div>

    <div class="form-group url-inputs">
        <label for="exampleInputEmail1">URL </label>
        <hr>
        <input type="url" name="url_youtube[]" class="form-control" placeholder="Enter Your URL">
        <hr>
    </div>

    <button type="button" class="btn btn-primary add-url"> <i class="fas fa-plus"></i> Add New URL </button>

    <hr>


    <div class="form-group bmd-form-group">
        @php $input = "theory_hour"; @endphp
        <label class="bmd-label-floating">{{trans("admin.theory_hour")}}</label>
        <input type="number" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group bmd-form-group">
        @php $input = "applied_hour"; @endphp
        <label class="bmd-label-floating">{{trans("admin.applied_hour")}}</label>
        <input type="number" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <hr>
    <div class="form-group">
        <label for="exampleInputEmail1">{{trans('admin.start_scheduling')}}</label>
        <input type="text" name="start_scheduling" class="form-control" id="datetimepicker" autocomplete="off">
        <hr>
        <label for="exampleInputEmail1">{{trans('admin.finish_scheduling')}}</label>
        <input type="text" name="finish_scheduling" class="form-control" id="datetimepicker2" autocomplete="off">
        <hr>
    </div>
</div>

@push('js')
<script src="{{url('/')}}/Admin/assets/js/jquery.datetimepicker.full.min.js"></script>
@endpush
