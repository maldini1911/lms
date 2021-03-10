@extends('Admin.index')
@section('title-page')
<i class="fas fa-user" style="color:#13C5EB"></i> Admin View <hr>
@endsection

@section('content')
<div class="image-box-doctor text-center">
        <img src="{{url('/')}}/adminlte/img/avatar5.png">
    </div>
<div class='show-doctor'>

    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
                <tr>
                    <td width="100px">ID</td>
                    <td> {{$row->id}}</td>
                </tr>
                <tr>
                    <td width="100px">Name</td>
                    <td> {{$row->name}}</td>
                </tr>
                <tr>
                    <td width="100px">Email</td>
                    <td> {{$row->email}}</td>
                </tr>
                <tr>
                    <td width="100px">Mobile</td>
                    <td> {{$row->mobile}}</td>
                </tr>

        </table>
    </div>
</div>
@endsection
