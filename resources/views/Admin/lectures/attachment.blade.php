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
                                    <div class="card">
                                        <div class="card-body">

                                           <iframe src="https://docs.google.com/gview?url={{url('/')}}/uploads/attachments/{{$row->file_name}}&embedded=true" width="100%" height="500px">
                                              
                                           </iframe>
                                            <object src="{{url('/')}}/uploads/attachments/{{$row->file_name}}"></object>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
          <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection
