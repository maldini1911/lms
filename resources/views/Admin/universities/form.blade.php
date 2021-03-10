{{csrf_field()}}

<div class="row">
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
            @php $input = "name"; @endphp
            <label class="bmd-label-floating">University Name</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}">


            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


    </div>
</div>
