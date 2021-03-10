@extends('Design.index')
@include('Design.layouts.nav')
@section('info')

 <!-- Start Header -->
    <header>
      <div class="overly">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6 wow bounceInLeft">
                      <div class="header-box">
                          <h1> Header</h1>
                          <p>
                              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea voluptatum eligendi est. Quidem
                              ducimus voluptate, explicabo repellat recusandae nemo
                              deserunt beatae. Distinctio, sequi ducimus! Perferendis consequatur consectetur porro esse vel.
                          </p>


                      </div>
                  </div>

                  <div class="col-lg-6 wow bounceInRight box-img">
                      <img src="{{url('/')}}/frontend/images/edu_ilastration.png">
                  </div>
              </div>
          </div>
      </div>
    </header>
  <!-- End Header -->

  <!-- Start About -->
  <section class="about" id="about">
      <div class="container">
          <h2 class="text-center wow bounceInDown"> About </h2>
          <div class="row">
              <div class="col-lg-12">
                  <div class="about-box text-center wow bounceInUp">
                      <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit.
                          Quidem porro atque aut quaerat veniam doloremque, dolores voluptatum accusamus cumque!
                          Laborum dolores ab totam nemo voluptatibus quisquam assumenda fugit, quasi voluptates.
                          Lorem ipsum dolor sit amet consectetur adipisicing elit.
                          Quidem porro atque aut quaerat veniam doloremque, dolores voluptatum accusamus cumque!
                          Laborum dolores ab totam nemo voluptatibus quisquam assumenda fugit, quasi voluptates.
                      </p>
                  </div>
              </div>
          </divc>
      </div>
  </section>
  <!-- End About -->

  <!-- Start Services -->
  <section class="services" id="service">
      <div class="container">
          <h2 class="text-center"> Services</h2>
          <div class="row text-center">
              <div class="col-lg-4 col-sm-12 col-xs-12 wow bounceInLeft">
                  <div class="box-servcie">
                      <i class="fas fa-chalkboard-teacher"></i>
                      <h4>Experienced Doctors</h4>
                  </div>
              </div>

              <div class="col-lg-4 col-sm-12 col-xs-12 wow bounceInUp">
                  <div class="box-servcie">
                      <i class="fas fa-book-open"></i>
                      <h4>Premium Content</h4>
                  </div>
              </div>

              <div class="col-lg-4 col-sm-12 col-xs-12 wow bounceInRight">
                  <div class="box-servcie">
                      <i class="fas fa-photo-video"></i>
                      <h4>Electronic Education</h4>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- End Services -->

  @include('Design.contact')


@endsection
