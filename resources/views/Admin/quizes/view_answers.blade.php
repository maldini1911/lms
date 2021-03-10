@extends('Admin.index')

@section('title-page') <i class="fas fa-user"></i> {{$row->student['name']}} <hr> @endsection

@section('content')

<div class="row">

    <div class="col-lg-6 text-center">
      <div class="card" style="height:250px">
        @if($row->answer != null)
        <img class="card-img-top" src="{{url('/')}}/uploads/questions/quizes/{{$row->answer}}" alt="Card image cap" id="url-image">
        <div class="card-body">
          <h5 class="alert alert-primary" style="width:200px;margin:auto">Answer Student</h5>
        </div>
        @else
        <div class="card-body">
          <h5 class="alert alert-danger" style="width:200px;margin:auto">margin:auto">Not Found Answer</h5>
        </div>
        @endif
      </div>
    </div>

    <div class="col-lg-6 text-center">
      <div class="card" style="height:250px">
        @if($row->anwser_image != null)
        <img class="card-img-top" src="{{url('/')}}/uploads/questions/quizes/editImage/{{$row->anwser_image}}" alt="Card image cap" id="url-image">
        <div class="card-body">
          <h5 class="alert alert-primary" style="width:200px;margin:auto">After Edit</h5>
        </div>
        @else
        <div class="card-body" style="margin-top:70px">
          <h5 class="alert alert-danger" style="width:200px;margin:auto">Image Not Edit </h5>
        </div>
        @endif
      </div>
    </div>

    <div class="col-lg-12 text-center">
      <div class="card">
        <div id="wrap">
          <div id="main" style="width:40%;margin:auto">
            <canvas id="cc"></canvas>
          </div>
          <a id = "bBrush" class="list-group-item alert alert-primary" style="width:150px;color:#fff;font-weight:bolder"> <i class="fas fa-broom"></i> Brush</a>

          </div>
        </div>
    </div>


    <div class="col-lg-4">
      <form action="{{url('doctors/quizes/post/edit/image/'.$row->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" class="form-control" name="anwser_image">
        <br>
        <label class="bmd-label-floating">Mark</label>
        <input type="number" class="form-control" name="mark" required="required">
        <br>
        <button type="submit" class="btn btn-success" disabled> Send To Student </button>
       </form>
    </div>

</div>

@endsection
