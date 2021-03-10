@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Lessons @endsection

@section('content')

@if($rows->isNotEmpty())
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
             <th>{{trans('admin.doctor_name')}}</th>
             <th>Course</th>
             <th>Count</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody>


        @foreach($rows as $row)
            @if($row->course['term_id'] == $user_term_id->term_id)
                <tr>
                    <td>{{$row->doctor['name']}}</td>
                    <td>{{$row->course['name']}}</td>
                    <td>{{$row->select('id')->where('lesson_status', 'publish')->where('doctor_id', $row->doctor['id'])->count()}}</td>
                    <td style="display: inline-flex">
                        <a class="btn btn-info btn-md link-show"  href="{{url('view/lessons/'.$row->doctor_id)}}" class="link-edit btn">Show</a>
                    </td>
                </tr>
                @endif
        @endforeach
    </tbody>
</table>
</div>

@else
<h4 class="text-center alert alert-danger alert-lg" style="margin-top:150px"> Not Found Any Lessons To This A Course</h4>
@endif
@endsection
