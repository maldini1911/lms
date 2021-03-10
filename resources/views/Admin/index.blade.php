@include('Admin.layout.header')
@include('Admin.layout.nav')
@include('Admin.layout.aside')

@section('page_title')

@endsection

@yield('dashborad')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="overflow:hidden">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="padding:10px 20px;">@yield('title-page')</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid" >
            @yield('content')
      </div><!--/. container-fluid -->
    </div>
    <!-- /.content -->
  </div>

@include('Admin.layout.footer')
