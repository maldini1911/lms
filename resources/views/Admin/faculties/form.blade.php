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


        <div class="col-md-12">
            <div class="form-group bmd-form-group">
                @php $input = "university_id"; @endphp
                <label class="bmd-label-floating">University</label>
                <select name="{{$input}}" class="form-control">
                    @isset($row)
                        <option value="{{$row->university->id}}">{{$row->university->name}}</option>
                    @endisset
                    @foreach($universities as $university)
                        <option value="{{$university->id}}">{{$university->name}}</option>
                    @endforeach
                </select>
                @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    </div>
</div>
