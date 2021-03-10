@extends('Admin.index')

@section('content')
<div class="row">
  <div class="col-md-12">
  <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                  Interactive Sessions
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="height:10px;"></div>
                        <iframe style="border:none; height: 600px; width: 100%;" src="{{$new_url}}" sandbox="allow-forms allow-scripts allow-same-origin" allow="microphone; camera" > <iframe>
                      </div>
                    </div>
                 </div>
            <!-- /.card-body -->
          </div>
  </div>
</div>

@endsection
