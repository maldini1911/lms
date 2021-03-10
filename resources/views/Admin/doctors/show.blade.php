@extends('Admin.index')

@section('content')
<div class="image-box-doctor text-center">
        @isset($row)
          @if($row->image != null)
              <img src="{{url('/')}}/uploads/doctors/{{$row->image}}">
          @else
            <img src="{{url('/')}}/adminlte/img/avatar5.png">
          @endif
        @endisset
    </div>
<div class='show-doctor'>

    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
                <tr>
                    <td width="100px">ID</td>
                    <td> {{$row->id}}</td>
                </tr>
                <tr>
                    <td width="100px">{{trans('admin.position')}}</td>
                    <td>{{str_replace('_', ' ', $row->role)}} </td>
                </tr>
                <tr>
                    <td width="100px">Name</td>
                    <td> {{$row->name}}</td>
                </tr>
                <tr>
                    <td width="100px">Email</td>
                    <td> {{$row->email}}</td>
                </tr>
                <tr>
                    <td width="100px">Mobile</td>
                    <td> {{$row->mobile}}</td>
                </tr>
                <tr>
                    <td width="150px">{{trans('admin.starting_work')}}</td>
                    <td>{{$row->work_start}} </td>
                </tr>
        </table>
    </div>
    <hr>
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped text-center">
        <thead>
          <tr>
                <th> {{trans('admin.faculty_name')}}</th>
                <th> {{trans('admin.academic_year')}}</th>
                <th> {{trans('admin.term')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach(App\Models\DoctorTerm::where('doctor_id', $row->id)->get() as $row)

            <tr>
                  <td>{{$row->term->faculty['name']}} </td>
                  <td>
                           @if($row->term['academic_year'] == 1)
                               {{trans('admin.one_year')}}
                           @elseif($row->term['academic_year'] == 2)
                               {{trans('admin.two_year')}}
                          @elseif($row->term['academic_year'] == 3)
                                {{trans('admin.three_year')}}
                          @elseif($row->term['academic_year'] == 4)
                                {{trans('admin.four_year')}}
                           @endif
                  </td>
                  <td>
                    @if($row->term['term'] == 1)
                      {{trans('admin.one_term')}}
                    @elseif($row->term['term'] == 2)
                      {{trans('admin.two_term')}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
