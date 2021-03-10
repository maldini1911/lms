@extends('Admin.index')

@section('title-page') <i class="fas fa-users"></i> All Students @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])

@section('link')
<hr>
<form action="{{url('admin/students/excel')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="file" name="students" class='form-control'>
    <br>
    <button type="submit" class="btn btn-success" style="width:200px"> Bulk Students</button>
    <a href="{{url('/')}}/uploads/attachments/students.xlsx" class="card-link btn btn-info">  Download Sample </a>
</form>
@endsection
<br>

@include("Admin.shared.delete_all")

<div class="table-responsive">
  <!-- Start Delete All -->
  <form action="{{url('admin/students/delete/all')}}" method="post" id="form_delete">
      {!! csrf_field() !!}
      <input type="hidden" name="_method" value="DELETE">
  <!-- End Delete All -->
    <table id="students" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
            <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Faculty</th>
            <th> Squad</th>
            <th> Term </th>
            <th style="width:100px"> Action</th>
           </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
          <tr>
            <td> @include('Admin.shared.buttons.checkbox')</td>
            <td> {{$row->id}}</td>
            <td> {{$row->name}}</td>
            <td> {{$row->email}}</td>
            <td> {{$row->mobile}}</td>
            <td> {{$row->faculty['name']}}</td>
            <td>
              @foreach(App\Models\StudentTerm::where('student_id', $row->id)->get() as $term)
                @if($term->term['academic_year'] == 1)
                   {{trans('admin.one_year')}}
                 @elseif($term->term['academic_year'] == 2)
                   {{trans('admin.two_year')}}
                 @elseif($term->term['academic_year'] == 3)
                   {{trans('admin.three_year')}}
                 @elseif($term->term['academic_year'] == 4)
                   {{trans('admin.foure_year')}}
                 @endif
              @endforeach
            </td>
            <td>
              @foreach(App\Models\StudentTerm::where('student_id', $row->id)->get() as $term)
                @if($term->term['term'] == 1)
                   {{trans('admin.one_year')}}
                 @elseif($term->term['term'] == 2)
                   {{trans('admin.two_year')}}
                 @endif
              @endforeach
            </td>
            <td class="flex">
              <a href="{{url('admin/students/'.$row->id)}}" class="btn btn-info btn-md link-delete"> Show </a>
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
  $(function () {
    $("#students").DataTable(
      {
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "paging": false
      }
    );

  });
</script>

@endpush

@endsection
