@include('Admin.layout.header')
@include('Admin.layout.message')



<section class="login-admin" id="login">
  <div class="login-box">
    <div class="login-logo">

    </div>
    <!-- /.login-logo -->
    <div class="card" style="background-color:transparent!important;" >
      <div class="card-body login-card-body" style="background-color:rgba(0,0,0,.5);color:white;border-radius:35px;">
        <center>
        <img src="{{url('/adminlte/img/logo.png')}}" id="logo">
        </center>
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="{{url('admin/login')}}" method="post">
          {!! csrf_field() !!}
            <div class="input-group mb-3">
              <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
               @enderror
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
               @enderror
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
        </form>
        <hr>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
</section>



<style>
body{

  background-image:url('{{url('/adminlte/img/back_3.jpg')}}')!important;
  background-repeat: no-repeat!important;
  background-size: cover!important;


}
.color_background{
  position: absolute;
  z-index:2!important;
  background-color:red!important;
  opacity: 0.3!important;
}
#login{

  margin-top:30%;
  z-index:3!important;
}
#logo{
  width:200px;
  height:100px;
  padding-bottom:10px;
}

</style>
