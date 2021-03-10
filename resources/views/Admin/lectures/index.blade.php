@extends('Admin.index')

@section('title-page') <i class="fas fa-film nav-icon"></i> All Lectures @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => 'lectures', 'routeName' => $routeName])

@include("Admin.shared.delete_all")

     <!-- Start Delete All -->
     <form action="{{url('doctors/lectures/delete/all')}}" method="post" id="form_delete">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="DELETE">
        <!-- End Delete All -->

        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
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
                @foreach($rows as $row)
                    <tr>
                        <td> @include('Admin.shared.buttons.checkbox')</td>
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
            							Not Not Scheduling
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
                            @include('Admin.shared.buttons.edit')
                            @include('Admin.shared.buttons.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </form>

{!! $rows->links() !!}

@endcomponent


@push('js')

<script>

delete_all();

</script>

@endpush
@endsection
