@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> My Courses @endsection

@section('content')

<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
              <th style="background:#ccc">COURSES</th>
              <th>CONTENT</th>
              <th>YEAR</th>
              <th>SQUAD</th>
              <th>TERM</th>
              <th>DEP.</th>
              <th>FACULTY</th>
              <th>UNIVIRSTY</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
              <td style="background:#ccc">{{$row->course['name']}}</td>
              <td>
                <p class="count-courses"> Lectures [{{$row->course->lectures->count()}}]</p>
                <p> Lessons [{{$row->course->lessons->count()}}] </p>
              </td>
              <td>{{$row['academic_year']}}</td>
              <td>
                @if($row->course->squad['academic_year'] == 1)
                    {{trans("admin.year_one")}}
                  @elseif($row->course->squad['academic_year'] == 2)
                      {{trans("admin.year_two")}}
                  @elseif($row->course->squad['academic_year'] == 3)
                      {{trans("admin.year_three")}}
                  @elseif($row->course->squad['academic_year'] == 4)
                      {{trans("admin.year_four")}}
                  @elseif($row->course->squad['academic_year'] == 5)
                      {{trans("admin.year_five")}}
                @endif
              </td>
              <td>
                @if($row->course->term_id)
                  @if($row->course->term['term'] == 1)
                      {{trans("admin.one_term")}}
                    @elseif($row->course->term['term'] == 2)
                        {{trans("admin.two_term")}}
                  @endif
                @else
                  Null
                @endif
              </td>
              <td>{{$row->course->specialty['name']}}</td>
              <td>{{$row->course->specialty->faculty['name']}}</td>
              <td>{{$row->course->specialty->faculty->university['name']}}</td>

          </tr>
          @endforeach
      </tbody>
    </table>
</div>
@endsection
