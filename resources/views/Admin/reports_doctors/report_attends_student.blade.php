@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Report - Student Reports @endsection

@section('content')

    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th>Student</th>
                <th>Lecture</th>
                <th> Year</th>
                <th>Term</th>
                <th>Login</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
            <tr>
              <th> {{$row->student_id ? $row->student['name'] : 'Null Data'}}</th>
              <th> {{$row->lecture_id ? $row->lecture['title'] : 'Null Data'}}</th>
              <th>
      				<?php $squad = App\Models\StudentTerm::where('student_id', $row->student_id)->first()->term['academic_year']; ?>
      				  @if($squad == 1)
      				  		{{trans('admin.one_year')}}
      				  @elseif($squad == 2)
      				  		{{trans('admin.two_year')}}
      				  @elseif($squad == 3)
      				  		{{trans('admin.three_year')}}
      				  @elseif($squad == 4)
      				  		{{trans('admin.four_year')}}
      				  @elseif($squad == 5)
      				  		{{trans('admin.five_year')}}
      				  @endif
      			  </th>
                   <th>
      				<?php $term = App\Models\StudentTerm::where('student_id', $row->student_id)->first()->term['term']; ?>
      				  @if($term == 1)
      				  		{{trans('admin.one_term')}}
      				  @elseif($term == 2)
      				  		{{trans('admin.two_term')}}
      				  @endif
      			  </th>
              <th> {{$row->created_at ? $row['created_at'] : 'Null Data'}}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$rows->links()}}
    </div>


@endsection
