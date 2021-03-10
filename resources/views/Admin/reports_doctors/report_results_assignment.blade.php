@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Report - Assignmnets Results @endsection

@section('content')



        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                    <th>Assignment</th>
                    <th>Course</th>
                    <th> {{trans('admin.doctor_name')}}</th>
                    <th> Student</th>
                    <th>Result</th>
                    <th>Full Mark</th>
                    <th>Status Result</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        @if($row->assignment->doctor['id'] == Auth()->guard('doctor')->user()->id)
                            <tr>
                                <th>{{$row->assignment['code_assignment']}}</th>
                                <th>{{$row->assignment->course['name']}}</th>
                                <th>{{$row->assignment->doctor['name']}}</th>
                                <th>{{$row->student['name']}}</th>
                                <th style="color:#ff0000">{{$row['student_mark']}} M</th>
                                <th style="color:#ff0000">{{$row->assignment['fullmark']}} M</th>
                                <th style="color:#ff0000">{{$row['result']}} </th>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{$rows->links()}}
        </div>


@endsection
