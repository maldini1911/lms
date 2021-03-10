@extends('Admin.index')

@push('css')
<style>
  .show-courses tr td:last-child{width: 100px}
</style>
@endpush
@section('content')
<div class='show-courses'>
    <a href="{{url('admin/courses')}}" class="btn btn-primary"> All {{trans('admin.courses')}}</a>
    <hr>
    <h2 class="text-center"> {{trans('admin.form12')}} </h2>
    <hr>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <tr>
               <th>
                 <ul class="list-unstyled text-left">
                    <li>
                      <span class="course-data"> {{trans('admin.academic_year')}}  : </span>
                       @if($row->squad['academic_year'] == 1)
                            {{trans('admin.year_one')}}
                        @elseif($row->squad['academic_year'] == 2)
                          {{trans('admin.year_two')}}
                        @elseif($row->squad['academic_year'] == 3)
                          {{trans('admin.year_three')}}
                        @elseif($row->squad['academic_year'] == 4)
                          {{trans('admin.year_four')}}
                        @elseif($row->squad['academic_year'] == 5)
                          {{trans('admin.year_five')}}
                        @endif
                   </li>

                   <li>
                     <span class="course-data"> {{trans('admin.term')}} : </span>
                      @if($row->term == Null)
                           All Year
                       @else
                         @if($row->term['term'] == 1)
                             {{trans('admin.one_term')}}
                         @elseif($row->term['term']  == 2)
                           {{trans('admin.two_term')}}
                         @endif
                       @endif
                  </li>

                  <li>
                    <span class="course-data"> {{trans('admin.years')}} : </span>
                      {{date('Y', strtotime('-1 year'))}} / {{date('Y')}}
                 </li>
                 </ul>
               </th>
               <th class="text-left"><span class="course-data">{{trans("admin.faculty_name")}} : </span> {{$row->specialty->faculty['name']}}  </th>
               <th class="text-left"><span class="course-data">{{trans('admin.name')}} : </span> {{$row['name']}}  </th>
            </tr>
            <tr>
                <th class="text-left"> <span class="course-data"> {{trans('admin.department')}} </span> : {{$row->specialty['name']}}</th>
                <th class="text-left"> <span class="course-data">{{trans('admin.type')}} :</span> {{$row->type}}</th>
                <th class="text-left">
                   <span class="course-data">{{trans('admin.course_hour')}} : </span>
                   @if($row->theory_hour != null)
                    {{trans('admin.theory_hour')}} [{{$row->theory_hour}}]
                   @endif

                   @if($row->applied_hour != null)
                    {{trans('admin.applied_hour')}} [{{$row->applied_hour}}]
                   @endif
                 </th>
            </tr>
          </table>
    </div>

    <hr>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td class="text-right">{!! $row->course_goals ? $row->course_goals : trans('admin.empty') !!} </td>
                    <th class="course-data">{{trans('admin.course_goals')}}</th>
                  </tr>

                  <tr>
                     <tr>
                      <td class="text-right">{!! $row->information_concepts ? $row->information_concepts : trans('admin.empty') !!} </td>
                      <th class="course-data">{{trans('admin.information_concepts')}}</th>
                  </tr>

                    <tr>
                      <td class="text-right">{!! $row->skills_mindset ? $row->skills_mindset : trans('admin.empty') !!} </td>
                      <th class="course-data">{{trans('admin.skills_mindset')}}</th>
                    </tr>
                  </tr>

                  <tr>
                    <td class="text-right">{!! $row->skills_professional ? $row->skills_professional : trans('admin.empty') !!} </td>
                    <th class="course-data">{{trans('admin.skills_professional')}}</th>
                  </tr>

                  <tr>
                    <td class="text-right">{!! $row->skills_public ? $row->skills_public : trans('admin.empty') !!} </td>
                    <th class="course-data">{{trans('admin.skills_public')}}</th>
                  </tr>
        </table>
    </div>


    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>{{trans('admin.title')}}</th>
                  <th>{{trans('admin.doctor_name')}}</th>
                  <th>Course</th>
                  <th>Lecture Status </th>
                  <th>{{trans('admin.lecture_hour')}} </th>
                  <th> {{trans('admin.start_scheduling')}}</th>
                  <th> {{trans('admin.finish_scheduling')}}</th>
                  <th>{{trans('admin.date')}} </th>
                  <th>Control</th>
              </tr>
          </thead>
          <tbody>
              @foreach(App\Models\Lecture::where('course_id', $row->id)->get() as $row)
                  <tr>
                      <td>{{$row->id}}</td>
                      <td>{{$row->title}}</td>
                      <td>{{$row->doctor['name']}}</td>
                      <td>{{$row->course['name']}}</td>
                      <td>{{strtoupper($row->lecture_status)}}</td>
                      <td>{{$row->lecture_hour ? $row->lecture_hour: 'Not Select'}}</td>
                      <td>
                        @if($row->lecture_status == 'scheduling')
                            @if($row->start_scheduling)
                                {{$row->start_scheduling}}
                            @else
                                Not Select Data
                            @endif
                        @else
                         Not Scheduling
                        @endif
                      </td>

                <td>
                        @if($row->lecture_status == 'scheduling')
                            @if($row->finish_scheduling)
                                {{$row->finish_scheduling}}
                            @else
                                Not Select Data
                            @endif
                        @else
                        Not Scheduling
                        @endif
                      </td>
                      <th> {{$row->created_at}}</th>
                      <td style="display: inline-flex">
                          <a class="btn btn-info btn-md link-show"  href="{{url('doctors/lectures/view/'.$row->id)}}" class="link-edit btn">Show</a>

                  </tr>
              @endforeach
          </tbody>
      </table>
      </div>
    </div>
</div>
@endsection
