@extends('Admin.index')

@section('title-page') <i class="fas fa-user"></i> {{$row->name}} @endsection

@section('content')

<div class="text-center student-admin">
  <img src="{{url('/')}}/adminlte/img/avatar5.png">

  <div class="table-responsive">
    <table id="sutdents" class="table table-bordered table-striped text-center">
        <tr>
            <td style="width:100px"> ID</td>
            <td> {{$row->id}}</td>
        </tr>
        <tr>
            <td style="width:100px"> Name</td>
            <td> {{$row->name}}</td>
        </tr>
        <tr>
            <td style="width:100px"> Email</td>
            <td> {{$row->email}}</td>
        </tr>
        <tr>
            <td style="width:100px"> Mobile</td>
            <td> {{$row->mobile}}</td>
        </tr>

        <tr>
            <td style="width:100px"> Faculty</td>
            <td> {{$row->faculty['name']}}</td>
        </tr>

        <tr>
            <td style="width:100px"> Year</td>
            <td> {{$row->term['academic_year']}}</td>
        </tr>

        <tr>
            <td style="width:100px"> Term</td>
            <td> {{$row->term['term']}}</td>
        </tr>
    </table>
</div>

</div>
@endsection
