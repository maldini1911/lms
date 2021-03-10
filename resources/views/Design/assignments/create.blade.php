@extends('Admin.index')

@section('title-page') <i class="fas fa-user-plus"></i>  Create New Assignment @endsection
@section('content')
<div class="col-lg-12 content assignment">
    <section class="content">
        <div class="container-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4><i class="fas fa-pen-alt"></i> Choose the question type:</h4>
                        <hr>
                        <div class="type-questions">
                            <button class="btn btn-primary text-que"><i class="fas fa-plus"></i> Add Text question</button>
                            <button class="btn btn-primary choice-que"><i class="fas fa-plus"></i> Add Multiple-choice</button>
                            <button class="btn btn-primary img-que"><i class="fas fa-plus"></i> Add File Image</button>
                            <button class="btn btn-primary true-false"><i class="fas fa-plus"></i> Add True or Flase</button>
                            <button class="btn btn-success btn-send float-right" type="submit"><i class="fas fa-plus"></i> Add Button Finish Questions</button>
                        </div>
                        <hr>

                        <div class="questions">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <form action="{{url('assignments/store')}}" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="fixed-input">
                                                <div class="form-group bmd-form-group">
                                                    @php $input = "code_assignment"; @endphp
                                                    <label class="bmd-label-floating">Add Code Assignment</label>
                                                    <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{isset($row) ? $row->{$input}:''}}" required="required">
                                                    @error($input)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group bmd-form-group">
                                                    @php $input = "subject_id"; @endphp
                                                    <label class="bmd-label-floating">{{trans("admin.subject_name")}}</label>
                                                    <select name="{{$input}}" class="form-control">
                                                        @isset($row)
                                                        <optgroup label="{{$row->subject->term->academic_year}} - {{$row->subject->term->term}} ">
                                                            <option value="{{$row->subject_id}}"> {{$row->subject->name}} </option>
                                                        </optgroup>
                                                        @endisset
                                                        @foreach($subjects as $subject)
                                                        <optgroup label="{{$subject->term->academic_year}} - {{$subject->term->term}} ">
                                                            <option value="{{$subject->id}}"> {{$subject->name}} </option>
                                                        </optgroup>
                                                        @endforeach
                                                    </select>
                                                    @error($input)
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <hr>


                                            <div class="section-text-que"></div>
                                            <div class="section-choice-que"></div>
                                            <div class="section-img-que"></div>
                                            <div class="section-true-false"></div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
