@extends('Design.index')

@section('info')
<div class="auth-page">
    <div class='overly'>
      <div class="container">
        <center>
              <div class="col-lg-4 col-xl-4 col-md-12 col-12 wow bounceInLeft" style="background-color:transparent!important;margin-top:15%!important;">
                  <div class="form-box">
                    <center>
                    <img src="{{url('/adminlte/img/logo.png')}}" id="logo" alt="">
                    <br><br>
                    </center>
                      <form action="{{url('login')}}" method="POST">
                          {{csrf_field()}}
                          <div class="form-group">

                              <input type="text" class="form-control" placeholder="Username" name="name">
                          </div>
                          <div class="form-group">

                              <input type="password" class="form-control" placeholder="Passsword" name="password">
                          </div>


                          <div class="form-group">

                              <select class="form-control" id="sections" name="section">
                                  <option value="student"> Student </option>
                                  <option value="doctor"> Doctor </option>
                                  <option value="admin"> Admin</option>
                              </select>
                          </div>

                          <div class="form-group" >
                            <center>
                              <button type="submit" class="btn btn-primary col-12"> Login</button>
                              </center>
                          </div>

                      </form>

                          <center>

                      </center>
                  </div>

              </div>
          </div>
      </div>
    </div>
</div>
@endsection