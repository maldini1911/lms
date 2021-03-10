@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Report - Quizes Results @endsection

@section('content')



    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th>Quize</th>
                <th>Course</th>
                <th> {{trans('admin.doctor_name')}}</th>
                <th>Result</th>
                <th>Full Mark</th>
                <th>Status Result</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
                <tr>
                    <th>{{$row->quize['code_quize']}}</th>
                    <th>{{$row->quize->course['name']}}</th>
                    <th>{{$row->quize->doctor['name']}}</th>
                    <th style="color:#ff0000">{{$row['student_mark']}} M</th>
                    <th style="color:#ff0000">{{$row->quize['fullmark']}} M</th>
                    <th style="color:#ff0000">{{$row['result']}} </th>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$rows->links()}}
    </div>


@endsection
