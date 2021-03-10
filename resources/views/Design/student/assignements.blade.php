@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> Assignment @endsection

@if($rows->isNotEmpty())
@section('content')
<div class="assignemt_student">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Assignment Name</th>
            <th>Course</th>
            <th>Doctor</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        @if($row->doctor()->where('term_id', auth()->guard('student')->user()->term_id))
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->code_assignment}}</td>
            <td>{{$row->course['name']}}</td>
            <td>{{$row->doctor['name']}}</td>
            <td>
                <a class="btn btn-primary btn-md link-show"  href="{{url('view/assignment/'.$row->id)}}">Open Assignment</a>
                <a class="btn btn-danger btn-md link-show"  href="{{url('report/assignment/'.$row->id)}}">Report</a>
            </td>
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
