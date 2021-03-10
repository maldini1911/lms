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
                    <div class="col-lg-8">

                        <h6 class="alert alert-info"> Please Put Here Your API URL To Let Student Can Access Your Interactive Session</h6>
                        <form action="{{url('doctors/store/interactive/sessions')}}" method="POST">
                           {{csrf_field()}}
                           <input type="url" name="interactive_sessions" class="form-control" value="{{auth()->guard('doctor')->user()->interactive_sessions}}">
                           <br>
                           <button type="submit" class="btn btn-success"> Create</button>
                        </form>
                      </div>
                    </div>
                 </div>
            <!-- /.card-body -->
          </div>
  </div>
</div>

@endsection
