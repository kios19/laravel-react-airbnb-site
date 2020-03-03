@extends('layouts.app')

@section('content')
@php
    if (!Auth::guest()){
        $arr = array('userid'=>Auth::user()->id, 'rating'=>$rating, 'itemid' => $room[0]->id);
    }
    else{
        $arr = array( 'rating'=>$rating, 'itemid' => $room[0]->id);
    }
    $pkk =  json_encode($arr);
@endphp
<link href="{{ asset('css/images.css') }}" rel="stylesheet">
<body>
    <div class="site-section">
        <div class="container">
          <div class="row">

            <div class="col-md-8">

              <div class="row">


                <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
                  <div class="">
                    <div class="slider">

                        <a href="#slide-1">1</a>
                        @if($room[0]->image2)
                        <a href="#slide-2">2</a>
                        @endif
                        @if($room[0]->image3)
                        <a href="#slide-3">3</a>
                        @endif

                        <div class="slides">
                          <div id="slide-1">
                              <img src="/uploads/{{ $room[0]->image1}}" alt="Image" >
                          </div>
                          @if($room[0]->image2)
                          <div id="slide-2">
                              <img src="/uploads/{{ $room[0]->image2}}" alt="Image" >
                          </div>
                          @endif
                          @if($room[0]->image3)
                          <div id="slide-3">
                              <img src="/uploads/{{ $room[0]->image3}}" alt="Image" >
                          </div>
                          @endif

                        </div>
                      </div>

                  </div>
                </div>
                <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
                  <div class="h-entry">
                    <h2 class="font-size-regular"><a href="#">{{ $room[0]->title }}</a></h2>
                    <div class="meta mb-4">{{ $room[0]->location_name }}<span class="mx-2">&bullet;{{ $room[0]->price  }} sh per person&bullet;</span> {{ $room[0]->created_at }}<span class="mx-2">&bullet;</span> <a href="#">{{ $room[0]->type_name}}</a></div>
                    <p>{!! $room[0]->description !!}</p>
                    <div id="rater" >
                        <div id="infos" data={{ $pkk }} ></div>
                    </div>
                    <div >
                        <div id="homer" >
                            <div id="info" data={{ urlencode($groot) }} ></div>
                        </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-3 ml-auto">
              <div class="mb-5">
                <div class="bg-white">
                    <p class="mb-0 font-weight-bold">Location</p>
                    <p class="mb-4">{{ $room[0]->location_name }}</p>

                    <p class="mb-0 font-weight-bold">Type</p>
                    <p class="mb-4">{{ $room[0]->type_name }}</p>

                    <p class="mb-0 font-weight-bold">Max Children</p>
                    <p class="mb-4">{{ $room[0]->children }}</p>

                    <p class="mb-0 font-weight-bold">Max Adults</p>
                    <p class="mb-4">{{ $room[0]->adults }}</p>

                    <p class="mb-0 font-weight-bold">No rooms</p>
                    <p class="mb-4">{{ $room[0]->rooms }}</p>

                    <p class="mb-0 font-weight-bold">Condition</p>
                    <p class="mb-4">{{ $room[0]->condition }}</p>


                  </div>

            </div>

          </div>
        </div>
      </div>

      <div class="container col-md-7 mb-5 aos-init aos-animate" style="padding-top: 140px;">
        @comments(['model' => $room[0]])
    </div>



      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-3">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="footer-heading mb-4">Products</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="footer-heading mb-4">Features</h2>
                  <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Testimonials</a></li>
                    <li><a href="#">Contact Us</a></li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="footer-heading mb-4">Follow Us</h2>
                  <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                  <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
              <form action="#" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
              <div class="border-top pt-5">

              </div>
            </div>

          </div>
        </div>
      </footer>
    </div>
@endsection
