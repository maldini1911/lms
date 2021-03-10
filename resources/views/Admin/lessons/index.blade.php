@extends('Admin.index')

@section('title-page') <i class="fas fa-film nav-icon"></i> All Lessons @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => 'lessons', 'routeName' => $routeName])

@include("Admin.shared.delete_all")
<div class="table-responsive">

    <!-- Start Delete All -->
    <form action="{{url('doctors/lessons/delete/all')}}" method="post" id="form_delete">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">
        <!-- End Delete All -->

    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
              <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
              <th>ID</th>
              <th>{{trans('admin.title')}}</th>
              <th>{{trans('admin.doctor_name')}}</th>
              <th>Lecture</th>
              <th>Course</th>
              <th>Status</th>
              <th>{{trans('admin.lesson_hour')}}</th>
              <th>{{trans('admin.start_scheduling')}}</th>
			        <th>{{trans('admin.finish_scheduling')}}</th>
              <th>{{trans('admin.date')}}</th>
              <th>Control</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
              <tr>
                  <td> @include('Admin.shared.buttons.checkbox')</td>
                  <td>{{$row->id}}</td>
                  <td>{{$row->title}}</td>
                  <td>{{$row->doctor['name']}}</td>
                  <td><a href="{{url('doctors/lectures/view/'.$row->lecture['id'])}}">{{$row->lecture['title']}} </a></td>
                  <td>{{$row->course['name']}}</td>
                  <td>{{strtoupper($row->lesson_status)}}</td>
                  <td>{{$row->lesson_hour ? $row->lesson_hour . ' Hour' : 'Not Select'}}</td>
                  <td>
    							@if($row->lesson_status == 'scheduling')
    									@if($row->start_scheduling)
    											{{$row->start_scheduling}}
    									@else
    											Not Select Data
    									@endif
    							@else
    							Not Not Scheduling
    							@endif
						    </td>
    						<td>
    							@if($row->lesson_status == 'scheduling')
    									@if($row->finish_scheduling)
    											{{$row->finish_scheduling}}
    									@else
    											Not Select Data
    									@endif
    							@else
    							Not Scheduling
    							@endif
    						</td>
                  <td> {{$row->created_at}}</td>

                  <td style="display: inline-flex">
                      <a class="btn btn-info btn-md link-show"  href="{{url('doctors/view/lessons/'.$row->id)}}" class="link-edit btn">Show</a>
                      @include('Admin.shared.buttons.edit')
                      @include('Admin.shared.buttons.delete')

                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
</form>
</div>
{!! $rows->links() !!}

@endcomponent


@push('js')

<script>

delete_all();


</script>


@endpush
@endsection
