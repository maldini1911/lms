  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="overly">
            <!-- Brand Logo -->
            <div class="text-center">
             <img src="{{url('/')}}/uploads/admin/setting/{{$setting->logo}}" alt="AdminLTE Logo" width="60%">
            </div>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                        @if(auth()->guard('web')->check())
                            <!-- Start Admin panel -->
                            <li class="nav-item has-treeview menu-open">

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{url('admin/dashboard')}}" class="nav-link">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>{{trans('admin.home_page')}}</p>
                                        </a>
                                    </li>
                                    <!-- Start Members -->
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>
                                            Members
                                            <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview" style="display: none;">
                                            <li class="nav-item">
                                                <a href="{{url('admin/users')}}" class="nav-link">
                                                <i class="fas fa-user-tie nav-icon"></i>
                                                <p>{{trans('admin.admins')}}</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{url('admin/doctors')}}" class="nav-link">
                                                <i class="fas fa-user-tie nav-icon"></i>
                                                <p>{{trans('admin.teaching')}}</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{url('admin/students')}}" class="nav-link">
                                                <i class="fas fa-user-tie nav-icon"></i>
                                                <p>Students</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End Members -->
                                    <hr class="small-size">
                                    <li class="nav-item">
                                        <a href="{{url('admin/universities')}}" class="nav-link">
                                        <i class="fas fa-university nav-icon"></i>
                                        <p>{{trans('admin.universities')}}</p>
                                        </a>
                                    </li>
                                    <hr class="small-size">

                                    <li class="nav-item">
                                        <a href="{{url('admin/faculties')}}" class="nav-link">
                                        <i class="fas fa-university nav-icon"></i>
                                        <p>{{trans('admin.faculties')}}</p>
                                        </a>
                                    </li>
                                    <hr class="small-size">

                                    <!-- <li class="nav-item">
                                        <a href="{{url('admin/terms')}}" class="nav-link">
                                        <i class="fas fa-calendar-alt nav-icon"></i>
                                        <p>Squad</p>
                                        </a>
                                    </li>
                                    <hr class="small-size"> -->

                                    <hr class="small-size">

                                    <li class="nav-item">
                                        <a href="{{url('admin/specialties')}}" class="nav-link">
                                        <i class="fas fa-heart nav-icon"></i>
                                        <p>Department</p>
                                        </a>
                                    </li>

                                    <hr class="small-size">
                                    <li class="nav-item">
                                        <a href="{{url('admin/courses')}}" class="nav-link">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p> Courses</p>
                                        </a>
                                    </li>

                                    <hr class="small-size">
                                    <li class="nav-item">
                                        <a href="{{url('admin/coursedoctors')}}" class="nav-link">
                                        <i class="fas fa-atlas nav-icon"></i>
                                        <p> Courses & Doctors</p>
                                        </a>
                                    </li>
                                    <hr class="small-size">

                                    <!-- Start Reportes -->
                                    <li class="nav-item has-treeview">
                                        <!-- Main Report -->
                                        <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                        <i class="fas fa-file-signature"></i>
                                            <p>
                                            Reportes

                                            <i class="fas fa-angle-left right"></i>
                                            <span class="right beta">Beta</span>
                                            </p>
                                        </a>
                                        <!-- End Main Report -->

                                        <!-- Start All Reports -->
                                        <ul class="nav nav-treeview" style="display: none;">
                                                <!-- Start Main Stuednt Reportes -->
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                                    <i class="fas fa-atlas nav-icon"></i>
                                                    <p> Student Reportes </p>
                                                    <i class="fas fa-angle-left right"></i>
                                                    </a>
                                                    <!-- Start Students Reportes -->
                                                    <ul class="nav nav-treeview" style="display: none;">
                                                    <!-- Start  Attendance-->
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                        <i class="fas fa-atlas nav-icon"></i>
                                                        <p>Attendance</p>
                                                        </a>
                                                    </li>
                                                    <!-- End Attendance -->

                                                    <!-- Start Marks-->
                                                    <li class="nav-item">
                                                        <a href="{{url('admin/reports/marks/assignments')}}" class="nav-link">
                                                        <i class="fas fa-atlas nav-icon"></i>
                                                        <p>Marks Assignments</p>
                                                        </a>
                                                    </li>


                                                    <li class="nav-item">
                                                        <a href="{{url('admin/reports/marks/quizes')}}" class="nav-link">
                                                        <i class="fas fa-atlas nav-icon"></i>
                                                        <p>Marks Quizes</p>
                                                        </a>
                                                    </li>
                                                    <!-- End Marks -->

                                                    <!-- Start Payments -->
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                        <i class="fas fa-atlas nav-icon"></i>
                                                        <p>Payments</p>
                                                        </a>
                                                    </li>
                                                    <!-- End Payments -->
                                                    </ul>
                                                    <!-- End Students Reportes -->

                                                </li>
                                                <!-- End Main Student Reportes -->

                                                <!-- Start Main Doctor Reportes -->
                                                <li class="nav-item">

                                                    <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                                      <i class="fas fa-atlas nav-icon"></i>
                                                      <p> Doctor Reportes </p>
                                                      <i class="fas fa-angle-left right"></i>
                                                    </a>


                                                    <!-- Start Doctores Reportes -->
                                                    <ul class="nav nav-treeview" style="display: none;">
                                                        <!-- Start Attendance -->
                                                        <li class="nav-item">
                                                            <a href="{{url('admin/reports/attends/students')}}" class="nav-link">
                                                            <i class="fas fa-atlas nav-icon"></i>
                                                            <p>Attendance</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Attendance -->

                                                        <!-- Start Student Marks -->
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                            <i class="fas fa-atlas nav-icon"></i>
                                                            <p>Student Marks</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Student Marks -->

                                                        <!-- Start Lectures -->
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                            <i class="fas fa-atlas nav-icon"></i>
                                                            <p>Lectures</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Lecture-->

                                                        <!-- Start Lessons -->
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                            <i class="fas fa-atlas nav-icon"></i>
                                                            <p>Lessons</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Lessons -->

                                                        <!-- Start Assignments -->
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                            <i class="fas fa-atlas nav-icon"></i>
                                                            <p>Assignments</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Assignments -->

                                                        <!-- Start Quizes -->
                                                        <li class="nav-item">
                                                            <a href="#" class="nav-link">
                                                              <i class="fas fa-atlas nav-icon"></i>
                                                              <p>Quizes</p>
                                                            </a>
                                                        </li>
                                                        <!-- End Quizes -->
                                                    </ul>
                                                    <!-- End Doctor Reportes -->

                                                </li>
                                                <!-- End Main Doctor Reportes -->
                                        </ul>
                                        <!-- End All Reports -->
                                    </li>
                                    <!-- End Reportes  -->

                                    <!-- End Admin panel -->
                                        <!-- Treeview -->
                                        <hr class="small-size">
                                        <li class="nav-item">
                                            <a href="{{url('admin/treeview')}}" class="nav-link">
                                            <i class="fas fa-atlas nav-icon"></i>
                                            <p> Admin Tree View Structure</p>
                                            <span class="right beta">Beta</span>
                                            </a>
                                        </li>
                                        <hr class="small-size">

                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="fas fa-chart-line nav-icon"></i>
                                            <p>Facilites</p>
                                            <span class="right beta">Beta</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                            <i class="fas fa-chart-line nav-icon"></i>
                                            <p>Finance</p>
                                            <span class="right beta">Beta</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{url('admin/setting')}}" class="nav-link">
                                            <i class="fas fa-cog nav-icon"></i>
                                            <p>Settings</p>
                                            </a>
                                        </li>

                                        </ul>
                                </li>
                            <!-- End Admin panel -->
                        @endif

                        @if(auth()->guard('doctor')->check())
                            <!-- Start Doctors -->
                            <li class="nav-item has-treeview menu-open">
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{url('doctors/course')}}" class="nav-link">
                                            <i class="fas fa-university nav-icon"></i>
                                        <p>My Course</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('doctors/lectures')}}" class="nav-link">
                                            <i class="fas fa-book-reader nav-icon"></i>
                                        <p>{{trans('admin.lectures')}}</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('doctors/lessons')}}" class="nav-link">
                                            <i class="fas fa-clipboard nav-icon"></i>
                                        <p>Lessons</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{url('doctors/show/interactive/sessions')}}" class="nav-link">
                                            <i class="fas fa-file-video nav-icon"></i>
                                        <p>Interactive Sessions</p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{url('doctors/assignments')}}" class="nav-link">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                        <p>{{trans('admin.assignments')}}</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{url('doctors/quizes')}}" class="nav-link">
                                            <i class="fas fa-file-signature nav-icon"></i>
                                        <p>Quizes</p>
                                        </a>
                                    </li>

                                    <!-- Start Projects -->
                                    <li class="nav-item has-treeview">
                                        <!-- Start Main Projects -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                            <i class="fas fa-user-graduate"></i>
                                            <p> Projects </p>
                                            <span class="right beta">Beta</span>
                                            <i class="fas fa-angle-left right"></i>
                                            </a>

                                            <!-- Start Doctores Reportes -->
                                            <ul class="nav nav-treeview" style="display: none;">
                                            <!-- Start Projects All -->
                                            <li class="nav-item">
                                                <a href="{{url('doctors/projects')}}" class="nav-link">
                                                <i class="fas fa-file-signature"></i>
                                                <p> All Projects </p>
                                                </a>
                                            </li>
                                            <!-- End Projects All -->

                                            <!-- Start Project Add -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Project Add</p>
                                                </a>
                                            </li>
                                            <!-- End Projects Add -->

                                            <!-- Start Projects Edit -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Project Edit</p>
                                                </a>
                                            </li>
                                            <!-- End Projects Edit -->

                                            <!-- Start Projects Detieles -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Project Detailes</p>
                                                </a>
                                            </li>
                                            <!-- End Projects Detieles -->
                                            </ul>
                                            <!-- End Projects -->

                                        </li>
                                        <!-- End Main Doctor Reportes -->
                                    </li>
                                    <!-- End Projects -->

                                    <!-- Start Reportes -->
                                    <li class="nav-item has-treeview">
                                        <!-- Start Main Doctor Reportes -->
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                              <i class="fas fa-flag"></i>
                                              <p> Doctor Reportes </p>
                                            <span class="right beta">Beta</span>
                                              <i class="fas fa-angle-left right"></i>
                                            </a>

                                            <!-- Start Doctores Reportes -->
                                            <ul class="nav nav-treeview" style="display: none;">
                                            <!-- Start Attendance -->
                                            <li class="nav-item">
                                                <a href="{{url('doctors/reports/attends/students')}}" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Attendance</p>
                                                </a>
                                            </li>
                                                <!-- End Attendance -->

                                            <!-- Start Student Marks -->
                                            <li class="nav-item">
                                                <a href="{{url('doctors/reports/marks/assignments')}}" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Student Marks Assignment</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="{{url('doctors/reports/marks/quizes')}}" class="nav-link">
                                                    <i class="fas fa-atlas nav-icon"></i>
                                                    <p>Student Marks Quize</p>
                                                </a>
                                            </li>
                                            <!-- End Student Marks -->

                                            <!-- Start Lectures -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                  <i class="fas fa-atlas nav-icon"></i>
                                                  <p>Lectures</p>
                                                </a>
                                            </li>
                                            <!-- End Lecture -->

                                            <!-- Start Lessons -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Lessons</p>
                                                </a>
                                            </li>
                                            <!-- End Lessons -->

                                            <!-- Start Assignments -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Assignments</p>
                                                </a>
                                            </li>
                                            <!-- End Assignments -->

                                            <!-- Start Quizes -->
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                <i class="fas fa-atlas nav-icon"></i>
                                                <p>Quizes</p>
                                                </a>
                                            </li>
                                            <!-- End Quizes -->
                                            </ul>
                                            <!-- End Doctor Reportes -->
                                        </li>
                                        <!-- End Main Doctor Reportes -->
                                    </li>
                                    <!-- End Reportes  -->

                                    <li class="nav-item">
                                        <a href="{{url('doctors/setting/'.auth()->guard('doctor')->user()->id)}}" class="nav-link">
                                        <i class="fas fa-cogs nav-icon"></i>
                                        <p>Setting</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Doctors -->
                        @endif

                        @if(auth()->guard('student')->check())
                            <!-- Start Studen -->
                            <li class="nav-item has-treeview menu-open">

                                <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{url('detailes/doctors')}}" class="nav-link">
                                              <i class="fas fa-users nav-icon"></i>
                                      <p>{{trans('admin.teaching')}}</p>
                                      </a>
                                  </li>

                                  <li class="nav-item">
                                        <a href="{{url('courses')}}" class="nav-link">
                                            <i class="fas fa-university nav-icon"></i>
                                        <p>My Courses </p>
                                        </a>
                                    </li>

                                  <li class="nav-item">
                                        <a href="{{url('lectures')}}" class="nav-link">
                                                <i class="fas fa-book-reader nav-icon"></i>
                                        <p>Lectures</p>
                                        </a>
                                    </li>

                                  <li class="nav-item">
                                          <a href="{{url('lessons')}}" class="nav-link">
                                              <i class="fas fa-clipboard nav-icon"></i>
                                          <p>Lessons</p>
                                          </a>
                                      </li>

                                  <li class="nav-item">
                                        <a href="#" class="nav-link">
                                                <i class="fas fa-file-video nav-icon"></i>
                                        <p>Interactive Sessions</p>

                                        </a>
                                    </li>


                                  <li class="nav-item">
                                        <a href="{{url('assignment')}}" class="nav-link">
                                            <i class="fas fa-file-alt nav-icon"></i>
                                        <p>{{trans('admin.assignments')}}</p>
                                        </a>
                                    </li>

                                  <li class="nav-item">
                                        <a href="{{url('quizes')}}" class="nav-link">
                                            <i class="fas fa-file-signature nav-icon"></i>
                                        <p>Quizes</p>
                                        </a>
                                    </li>

                                  <li class="nav-item">
                                      <a href="{{url('setting/'.auth()->guard('student')->user()->id)}}" class="nav-link">
                                      <i class="fas fa-cogs nav-icon"></i>
                                      <p>Setting</p>
                                      </a>
                                  </li>

                                    <!-- Start Reports -->
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link" style="background: rgba(255,255,255,.3);">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>
                                                Reports
                                                <i class="fas fa-angle-left right"></i>
                                            </p>
                                        </a>

                                        <ul class="nav nav-treeview" style="display: none;">
                                            <li class="nav-item">
                                                <a href="{{url('report/results/assignments')}}" class="nav-link">
                                                    <i class="fas fa-user-tie nav-icon"></i>
                                                    <p>Assignments Results </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{url('report/results/quizes')}}" class="nav-link">
                                                    <i class="fas fa-user-tie nav-icon"></i>
                                                    <p>Quizes Results</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{url('admin/students')}}" class="nav-link">
                                                    <i class="fas fa-user-tie nav-icon"></i>
                                                    <p>Students</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End Reports -->
                                </ul>
                            </li>
                            <!-- End Sudent -->
                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </div>
  </aside>


  <style>
  .small-size{
    margin:0;
    padding:0;
    font-size:1px;
  }


  </style>
