@extends('Admin.index')

@section('page_title','Dodo LMS')

@section('dashborad')
<!-- Start -->
@if(auth()->guard('doctor')->check())
<div class="content-wrapper">
    <div class="dashboard-style">
      <div class="row">

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="inner text-center">
                <i class="nav-icon fas fa-university"></i>
                <p>Total Courses </p>
                <h3>{{$courses_doctor}}</h3>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="inner text-center">
                <i class="nav-icon fas fa-university"></i>
                <p>Assigned Courses {{date('Y')}} </p>
                <h3>{{$courses_doctor_now}}</h3>
            </div>
        </div>
        <!-- ./col -->

          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-book-reader"></i>
                  <p>Lectures </p>
                  <h3>{{$lecture}}</h3>
              </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Lessons </p>
                  <h3>{{$lesson}}</h3>
              </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Assignments </p>
                  <h3>{{$assignment}}</h3>
              </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-file-signature"></i>
                  <p>Quizes </p>
                  <h3>{{$quize}}</h3>
              </div>
          </div>
          <!-- ./col -->
    </div>
    </div>

    <div class="container table-dashboard">
      <div class="row" >
              <div class="col-lg-12">
                <p style="color:red"> Your Assigned Courses<p>
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
                                <p class="count-courses"> Lectures [{{$row->course->lectures->where('lecture_status', 'publish')->count()}}]</p>
                                <p> Lessons [{{$row->course->lessons->where('lesson_status', 'publish')->count()}}] </p>
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
              </div>
          </div>
    </div>
</div>
@endif
<!-- End -->


<!-- Start -->
@if(auth()->guard('student')->check())
<div class="content-wrapper">
    <div class="dashboard-style">
      <div class="row">

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="inner text-center">
                <i class="nav-icon fas fa-university"></i>
                <p> Courses </p>
                <h3>{{$course}}</h3>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="inner text-center">
                <i class="nav-icon fas fa-user-tie"></i>
                <p> Doctors </p>
                <h3>{{$doctor}}</h3>
            </div>
        </div>
        <!-- ./col -->


          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-book-reader"></i>
                  <p>Lectures </p>
                  <h3>{{$lecture_student}}</h3>
              </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>Lessons </p>
                  <h3>{{$lesson_student}}</h3>
              </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Assignments </p>
                  <h3>{{$assignment_student}}</h3>
              </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-file-signature"></i>
                  <p>Quizes </p>
                  <h3>{{$quize_student}}</h3>
              </div>
          </div>
          <!-- ./col -->
    </div>
    </div>

    <div class="container table-dashboard">
      <div class="row" >
              <div class="col-lg-12">
                <p style="color:red"> Your Assigned Courses<p>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped text-center">
                      <thead>
                          <tr>
                              <th style="background:#ccc">COURSES</th>
                              <th>Type Course</th>
                              <th>CONTENT</th>
                              <th>SQUAD</th>
                              <th>TERM</th>
                              <th>YEAR</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($rows as $row)
                              <td style="background:#ccc">{{$row->course['name']}}</td>
                              <td>{{$row->course['type']}}</td>
                              <td>
                                <p class="count-courses"> Lectures [{{$row->course->lectures->where('lecture_status', 'publish')->count()}}]</p>
                                <p> Lessons [{{$row->course->lessons->where('lesson_status', 'publish')->count()}}] </p>
                              </td>
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

                              <td>{{$row['academic_year']}}</td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
    </div>
</div>
@endif
  <!-- End -->
@endsection




@section('content')

  <!-- Start -->
  @if(auth()->guard('web')->check())
    <!-- Start Row Chart -->
    <div class="row">
        <!-- Staet chart 1 -->
        <div class="col-lg-6 col-xs-12">
          <!-- LINE CHART -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Line Chart</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px; min-height:250px"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- End Chart 1 -->

        <!-- Start chart 2 -->
        <div class="col-lg-6 col-xs-12">
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="height:250px; min-height:250px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- End Chart 2 -->

        <!-- Start Chart 3 -->
        <div class="col-lg-12">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- End Chart 3 -->
    </div>
    <!-- End row Chart -->

    <div class="row" style="transform:translateX(10%)">

          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-university"></i>
                  <p> Universities </p>
                  <h4 class="number-count">{{$university}}</h4>
              </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-university"></i>
                  <p> Facilites </p>
                  <h4 class="number-count">{{$faculty}}</h4>
              </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-2 col-6">
                <!-- small box -->
                <div class="inner text-center">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>Docotrs </p>
                    <h4 class="number-count">{{$doctor}}</h4>
                </div>
            </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>Students </p>
                  <h4 class="number-count">{{$student}}</h4>
              </div>
            </div>

          <!-- ./col -->
          <div class="col-lg-2 col-6">
              <!-- small box -->
              <div class="inner text-center">
                  <i class="nav-icon fas fa-file-alt"></i>
                  <p>Courses </p>
                  <h4 class="number-count">{{$course}}</h4>
              </div>
          </div>
          <!-- ./col -->

    </div>
  @endif
  <!-- End -->



  @push('js')

  <script>
    $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

      var areaChartData = {
        labels  : ['Universities', 'Facilites', 'Doctors', 'Students', 'Courses'],
        datasets: [
          {
            label               : 'Digital Goods',
            backgroundColor     : '#F4D03F',
            borderColor         : '#FF8235',
            pointRadius          : false,
            pointColor          : '#16A085',
            pointStrokeColor    : '#FF8235',
            pointHighlightFill  : '#FF8235',
            pointHighlightStroke: '#FF8235',
            data                : [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label               : 'Electronics',
            backgroundColor     : 'rgba(210, 214, 222, 1)',
            borderColor         : 'rgba(210, 214, 222, 1)',
            pointRadius         : false,
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : [65, 59, 80, 81, 56, 55, 40]
          },
        ]
      }

      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : false,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }

      // This will get the first returned node in the jQuery collection.
      var areaChart       = new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
      })

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
      var lineChartData = jQuery.extend(true, {}, areaChartData)
      lineChartData.datasets[0].fill = false;
      lineChartData.datasets[1].fill = false;
      lineChartOptions.datasetFill = false

      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })



      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = jQuery.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      });


    });
  </script>
  @endpush
  @endsection
