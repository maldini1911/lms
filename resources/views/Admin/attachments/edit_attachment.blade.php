@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> {{$row->file_type}} @endsection

@section('content')
<div class="row" style="overflow:hidden">
  <div class="col-md-12">
    <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="session-box">
                                        <form action="{{url('doctors/attachment/edit/'.$row->id)}}" method="POST" enctype= multipart/form-data>
                                            {{csrf_field()}}

                                            <div class="form-group bmd-form-group ">
                                                @php $input = "file_type"; @endphp
                                                <label class="bmd-label-floating">Attachment Type</label>
                                                <select name="{{$input}}" class="form-control">
                                                    <option>..........</option>
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

                                            <div class="form-group bmd-form-group">
                                                    <button type="submit" class="btn btn-success">Edit</button>
                                            </div>

                                        </form>
                                </div>
                            </div>
                    </div>
            </div>
          <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection
