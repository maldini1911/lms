
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand" style="background:#333333">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @if(auth()->guard('student')->check())
        <a href="{{url('home')}}" class="nav-link"> {{trans('admin.home_page')}} </a>
        @endif

        @if(auth()->guard('web')->check())
        <a href="{{url('admin/dashboard')}}" class="nav-link"> {{trans('admin.home_page')}} </a>
        @endif

        @if(auth()->guard('doctor')->check())
        <a href="{{url('doctors/dashboard')}}" class="nav-link"> {{trans('admin.home_page')}} </a>
        @endif

      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    <!-- Start Web Guard -->
    @if(auth()->guard('web')->check())
        <!-- Start Language -->
        <li class="nav-item">
          @if(auth()->guard('web')->user()->image == null)
            <img src="{{url('/')}}/adminlte/img/boxed-bg.png" style="width:40px;height:40px;" class="img-circle" alt="">
          @else
          <img src="{{url('/')}}/uploads/admin/{{auth()->guard('web')->user()->image}}" style="width:40px;height:40px;" class="img-circle" alt="">
          @endif
              <span style="color:#fff"> {{auth()->guard('web')->user()->name}}</span>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" href="{{url('admin/logout')}}">
            <i class="fas fa-sign-out-alt"></i>  {{trans('admin.logout')}}
          </a>
        </li>
    @endif
    <!-- End Web Guard -->

    <!-- Start Notifactions Doctor -->
    @if(auth()->guard('doctor')->check())
        @php $user = \App\Models\Doctor::find(auth()->guard('doctor')->user()->id) @endphp
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-bell fa-lg" ></i>
            <span class="badge badge-warning navbar-badge">{{$user->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">{{$user->unreadNotifications->count()}} Notifications</span>
            <!-- Foreach Notifications -->

            @foreach($user->unreadNotifications as $notification)
            @if($notification->data['type'] == 'lecture')
                <div class="dropdown-divider"></div>
                {{$notification->markAsRead()}}
                <a href="{{url('details/lecture/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                <p class="text-center">{{$notification->data['doctor'] }} Add New Lecture</p>
                <p class="text-center"> {{$notification->data['title'] }}</p>
                </a>
                <hr>
            @endif
            @if($notification->data['type'] == 'lesson')
                <div class="dropdown-divider"></div>
                {{$notification->markAsRead()}}
                <a href="{{url('details/lesson/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                <p class="text-center">{{$notification->data['doctor'] }} Add New Lesson</p>
                <p class="text-center"> {{$notification->data['title'] }}</p>
                </a>
                <hr>
            @endif

            @if($notification->data['type'] == 'assignments')
                <div class="dropdown-divider"></div>
                {{$notification->markAsRead()}}
                <a href="{{url('view/assignment/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                <p class="text-center">{{$notification->data['doctor'] }} Add New Assignment</p>
                <p class="text-center"> {{$notification->data['title'] }}</p>
                </a>
                <hr>
            @endif

            @if($notification->data['type'] == 'quizes')
                <div class="dropdown-divider"></div>
                {{$notification->markAsRead()}}
                <a href="{{url('view/quize/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                <p class="text-center">{{$notification->data['doctor'] }} Add New Assignment</p>
                <p class="text-center"> {{$notification->data['title'] }}</p>
                </a>
                <hr>
            @endif

            @endforeach

            <!-- End -->
            </div>
        </li>
        <li class="nav-item">
              @if(auth()->guard('doctor')->user()->image == null)
              <img src="{{url('/')}}/adminlte/img/boxed-bg.png" style="width:40px;height:40px;" class="img-circle" alt="">
              @else
              <img src="{{url('/')}}/uploads/doctors/{{auth()->guard('doctor')->user()->image}}" style="width:40px;height:40px;" class="img-circle" alt="">
              @endif
              <span style="color:#fff"> {{auth()->guard('doctor')->user()->name}}</span>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" href="{{url('doctors/logout')}}">
                <i class="fas fa-sign-out-alt"></i>  {{trans('admin.logout')}}
            </a>
          </li>
    @endif
    <!-- End Notifactions Doctor -->

    <!-- Start Notifactions Student -->
    @if(auth()->guard('student')->check())
        @php $user = \App\Models\Student::find(auth()->guard('student')->user()->id) @endphp
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fas fa-bell fa-lg" ></i>
            <span class="badge badge-warning navbar-badge">{{$user->unreadNotifications->count()}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notifications">
              <span class="dropdown-item dropdown-header">{{$user->unreadNotifications->count()}} Notifications</span>
              <!-- Foreach Notifications -->
              @foreach($user->notifications()->limit(5)->get() as $notification)
                  @isset($notification->data['type'])
                    @if($notification->data['type'] == 'lecture')
                        <div class="dropdown-divider"></div>
                        {{$notification->markAsRead()}}
                        <a href="{{url('details/lecture/'.$notification->data['id_type'])}}" class="dropdown-item">
                          <p class="text-center" style="color:#111;font-weight:bold">Dr : {{$notification->data['doctor'] }} </p>
                          <hr>
                          <p class="text-center" style="color:#111;font-weight:bold"> Add New Lecture Now</p>
                          <hr>
                          <p class="text-center" style="color:#111;font-weight:bold"> {{$notification->data['title'] }}</p>
                        </a>
                        <hr>
                    @endif
                  @endisset

                  @isset($notification->data['type_scheduling'])
                      @if($notification->data['type_scheduling'] == 'lecture_scheduling')
                          <div class="dropdown-divider"></div>
                          {{$notification->markAsRead()}}
                          <p class="text-center">Dr : {{$notification->data['doctor'] }}</p>
                          <hr>
                          <p class="text-center"> {{$notification->data['title'] }}</p>
                          <hr>
                          <p class="text-center" style="font-size:14px"> Show Lecutre at {{$notification->data['scheduling'] }}</p>
                          <hr>
                      @endif

                      @if($notification->data['type_scheduling'] == 'lesson_scheduling')
                          <div class="dropdown-divider"></div>
                          {{$notification->markAsRead()}}
                          <p class="text-center">Dr : {{$notification->data['doctor'] }}</p>
                          <hr>
                          <p class="text-center"> {{$notification->data['title'] }}</p>
                          <hr>
                          <p class="text-center" style="font-size:14px;"> Show Lesson at {{$notification->data['scheduling'] }}</p>
                          <hr>
                      @endif
                  @endisset

                  @isset($notification->data['type'])
                      @if($notification->data['type'] == 'lesson')
                          <div class="dropdown-divider"></div>
                          {{$notification->markAsRead()}}
                          <a href="{{url('details/lesson/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                            <p class="text-center" style="color:#111;font-weight:bold">Dr : {{$notification->data['doctor'] }} </p>
                            <hr>
                            <p class="text-center" style="color:#111;font-weight:bold"> Add New Lesson Now</p>
                            <hr>
                            <p class="text-center" style="color:#111;font-weight:bold"> {{$notification->data['title'] }}</p>
                          </a>
                          <hr>
                      @endif
                  @endisset

                  @isset($notification->data['type'])
                      @if($notification->data['type'] == 'assignments')
                          <div class="dropdown-divider"></div>
                          {{$notification->markAsRead()}}
                          <a href="{{url('view/assignment/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                          <p class="text-center" style="color:#111;font-weight:bold">{{$notification->data['doctor'] }} Add New Assignment</p>
                          <hr>
                          <p class="text-center" style="color:#111;font-weight:bold"> {{$notification->data['title'] }}</p>
                          </a>
                          <hr>
                      @endif
                    @endisset

                    @isset($notification->data['type'])
                      @if($notification->data['type'] == 'quizes')
                          <div class="dropdown-divider"></div>
                          {{$notification->markAsRead()}}
                          <a href="{{url('view/quize/'.$notification->data['id_type'])}}" class="dropdown-item" style="background:#eee">
                          <p class="text-center" style="color:#111;font-weight:bold">{{$notification->data['doctor'] }} Add New Assignment</p>
                          <hr>
                          <p class="text-center" style="color:#111;font-weight:bold"> {{$notification->data['title'] }}</p>
                          </a>
                          <hr>
                      @endif
                  @endisset
              @endforeach
              <a href="#">
                <span class="dropdown-item dropdown-header text-center">All Notifications</span>
              </a>
          </div>
        </li>
        <li class="nav-item">
          @if(auth()->guard('student')->user()->image == null)
          <img src="{{url('/')}}/adminlte/img/boxed-bg.png" style="width:40px;height:40px;" class="img-circle" alt="">
          @else
          <img src="{{url('/')}}/uploads/students/{{auth()->guard('student')->user()->image}}" style="width:40px;height:40px;" class="img-circle" alt="">
          @endif
              <span style="color:#fff"> {{auth()->guard('student')->user()->name}}</span>
      </li>

        <li class="nav-item dropdown">
          <a class="nav-link" href="{{url('logout')}}">
              <i class="fas fa-sign-out-alt"></i>  {{trans('admin.logout')}}
          </a>
        </li>
    @endif
    <!-- End Notifactions Student -->

     <!-- Options Admin -->
    </ul>
  </nav>

  <!-- /.navbar -->
