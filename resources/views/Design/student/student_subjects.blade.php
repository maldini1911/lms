@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i>  My Courses @endsection

@section('content')

<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr style="background:#fff">
            <th>ID</th>
            <th>{{trans('admin.name')}}</th>
            <th>{{trans('admin.type')}}</th>
            <th>{{trans('admin.department')}}</th>
            <th>Totoal Hour</th>
            <th>{{trans('admin.lecture_hour')}}</th>
            <th>{{trans('admin.lesson_hour')}}</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
            @foreach($courses as $course)
              <tr style="background:#f2f2f2">
                  <th>{{$course->id}}</th>
                  <th>{{$course->name ? $course->name : trans('admin.empty')}}</th>
                  <th>{{$course->type ? $course->type : trans('admin.empty')}}</th>
                  <th>{{$course->specialty['name']}}</th>
                  <th>
                    {{
                      App\Models\Lecture::where('course_id', $course->id)->sum('lecture_hour')
                     +
                     App\Models\Lesson::where('course_id', $course->id)->sum('lesson_hour')
                   }}
                  </tth>
                  <th> {{App\Models\Lecture::where('course_id', $course->id)->sum('lecture_hour')}} </th>
                  <th> {{App\Models\Lesson::where('course_id', $course->id)->sum('lesson_hour')}}  </th>
                  <td><a href="{{url('lectures/'.$course->id)}}" class="btn btn-info"> {{trans('admin.view')}}</a></td>
              </tr>
            @endforeach
    </tbody>
</table>
</div>



@endsection
