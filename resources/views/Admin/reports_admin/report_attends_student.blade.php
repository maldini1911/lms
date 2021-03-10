@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> Report - Student Reports @endsection

@section('content')
<ul class="list-unstyled">
<li> All Users Attends This Year <span> {{$rows->where('year', date('Y'))->count()}}</span></li>
<li> All Users Attends All Years <span> {{$rows->count()}}</span></li>
</ul>
  <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
                <th>Student</th>
                <th>Lecture</th>
                <th> Year</th>
                <th>Term</th>
                <th>Login</th>
                <th>Logout</th>
                <th>Year</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $row)
            <tr>
              <th> {{$row->student_id ? $row->student['name'] : 'Null Data'}}</th>
              <th> {{$row->lecture_id ? $row->lecture['title'] : 'Null Data'}}</th>
              <th> {{$row->student_id ? $row->student->term['academic_year'] : 'Null Data'}}</th>
              <th> {{$row->student_id ? $row->student->term['term'] : 'Null Data'}}</th>
              <th> {{$row->created_at ? $row['created_at'] : 'Null Data'}}</th>
              <th> {{$row->student_out ? $row['student_out'] : 'Null Data'}}</th>
              <th> {{$row->year ? $row['year'] : 'Null Data'}}</th>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$rows->links()}}
    </div>

    @push('js')
    <script>
      $(function () {
        $("#example1").DataTable(
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
