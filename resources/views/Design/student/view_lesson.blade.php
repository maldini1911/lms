@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Lectures @endsection

@section('content')


@if($rows->isNotEmpty())
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped text-center">
    <thead>
        <tr>
             <th> {{trans('admin.doctor_name')}}</th>
             <th>{{trans('admin.position')}}</th>
             <th>{{trans('admin.title')}}</th>
             <th>{{trans('admin.theory_hour')}}</th>
             <th>{{trans('admin.applied_hour')}}</th>
             <th>{{trans('admin.lesson_hour')}}</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
          <tr>
               <td> {{$row->doctor['name']}} </td>
               <td> {{str_replace('_', ' ', $row->doctor['role'])}} </td>
               <td> {{$row->title}} </td>
               <td> {{$row->theory_hour ? $row->theory_hour : trans('admin.empty')}} </td>
               <td> {{$row->applied_hour ? $row->applied_hour : trans('admin.empty')}} </td>
               <td> {{$row->lesson_hour ? $row->lesson_hour : trans('admin.empty')}} </td>
               <td>
                  @if($row->lesson_status == 'publish')
                  <a href="{{url('details/lecture/'.$row->id)}}" class="btn btn-info"> {{trans('admin.view')}}</a>
                  @endif

                  @if($row->lesson_status == 'scheduling')
                      @if($row->start_scheduling != null)
                          <span style="color:red;font-weight:bolder"> {{$row->start_scheduling}} </span>
                      @else
                          <span style="color:red;font-weight:bolder"> {{trans('admin.soon')}} </span>

                      @endif
                  @endif
               </td>
          </tr>
        @endforeach
    </tbody>
</table>
</div>
@else
<h4 class="text-center alert alert-danger" style="margin-top:150px"> Not Found Any Lectures To This A Course</h4>
@endif

@endsection
