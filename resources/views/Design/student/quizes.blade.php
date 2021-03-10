@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> All Quizes @endsection

@section('content')

@if($rows->isNotEmpty())
    <div class="assignemt_student">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
            <tr>
                <th>ID</th>
                <th>Quize Name</th>
                <th>Doctor</th>
                <th>Course</th>
                <th>Control</th>
            </tr>
        </thead>
                <tbody>
        @foreach($rows as $row)
            @if($row->doctor()->where('term_id', auth()->guard('student')->user()->term_id))
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->code_quize}}</td>
                <td>{{$row->doctor['name']}}</td>
                <td>{{$row->course['name']}}</td>
                <td>
                    <a class="btn btn-primary btn-md link-show"  href="{{url('view/quize/'.$row->id)}}" class="link-edit btn">Open Quize</a>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
            </table>
        </div>
    </div>
@else
<h4 class="alert alert-dnager text-center"> Not Found Data</h4>
@endif

@endsection
