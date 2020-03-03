@extends('layouts.app')

@section('content')

<body>

  <div class="site-wrap">

    <!--div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg')}}');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">


            <div class="row justify-content-center">
              <div class="col-md-8 text-center">
                <h1>Listings</h1>
                <p class="mb-0">We Make You Better!</p>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div-->


    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
            <div class="col-md-4 text-left border-primary">
              <h2 class="font-weight-light text-primary">{{ $cate[0]->type_name }}</h2>
              <p class="color-black-opacity-5">The following are the results</p>
            </div>
          </div>
        <div class="row">
          <div class="col-lg-8">

            @if (count($rooms) >= 1)
            @foreach ($rooms as $room )
            <div class="d-block d-md-flex listing-horizontal">
                @php
                $rating = DB::table('ratings')
                    ->where('product_id','=',$room->id)
                    ->avg('rating');
                @endphp

                <a href="/rooms/room/{{ $room->id }}" class="img d-block" style="background-image: url('/uploads/{{ $room->image1 }}')">
                  <span class="category">{{ $room->type_name}}</span>
                </a>

                <div class="lh-content">
                    <a href="#" class="bookmark"><span class="">sh{{ $room->price  }}</span></a>
                  <h3><a href="/rooms/room/{{ $room->type_id }}">{{ $room->title }}</a></h3>
                  <p>{{ $room->location_name }}</p>
                  <p>
                    @for($i = 0; $i< $rating; $i++)
                    <span class="icon-star text-warning"></span>
                    @endfor

                  <span>({{$rating}} Rating)</span>
                </p>


                </div>

              </div>

            @endforeach
            {{ $rooms }}
            @endif


          </div>
          <div class="col-lg-3 ml-auto">

            <div class="mb-5">
              <h3 class="h5 text-black mb-3">Filters</h3>
              <form >
                <div class="form-group">
                  <input id="globo" type="text" placeholder="What are you looking for?" class="form-control">
                  <button style="display:none;" id="myBtn" onclick="submitForm(event)">Button</button>
                </div>
                <div class="form-group">
                    <div class="select-wrap">
                        <form method="get" action="">
                            <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                            <select name="event_edit" class="form-control"
                                onChange="window.location.href='/rooms/type/' + this.options[this.selectedIndex].value">
                                @foreach($categories as $event)
                                    <option value="{{$event->type_id}}">{{$event->type_name}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="form-group">
                  <!-- select-wrap, .wrap-icon -->
                  <div class="wrap-icon">
                    <span class="icon"><span class="icon-room"></span></span>
                    <select name="event_edit" class="form-control"
                        onChange="window.location.href='/location/' + this.options[this.selectedIndex].value">
                        @foreach($locations as $event)
                            <option value="{{$event->id}}">{{$event->location_name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </form>
            </div>

            <div class="mb-5">
                <div class="form-group">
                    <p>Select a price range</p>
                  </div>
                <div id="slides" >
                    <div id="infosa" data={{ "dsf"}} ></div>
                </div>
              <form action="#" method="post" style="display:none">
                <div class="form-group">
                  <p>Radius around selected destination</p>
                </div>
                <div class="form-group">
                  <input type="range" min="0" max="100" value="20" data-rangeslider>
                </div>
              </form>
            </div>

            <div class="mb-5" style="display:none">
                <form action="#" method="post">
                  <div class="form-group">
                    <p>Category 'Restaurant' is selected</p>
                    <p>More filters</p>
                  </div>
                  <div class="form-group">
                    <ul class="list-unstyled">
                      <li>
                        <label for="option1">
                          <input type="checkbox" id="option1">
                          Coffee
                        </label>
                      </li>
                      <li>
                        <label for="option2">
                          <input type="checkbox" id="option2">
                          Vegetarian
                        </label>
                      </li>
                      <li>
                        <label for="option3">
                          <input type="checkbox" id="option3">
                          Vegan Foods
                        </label>
                      </li>
                      <li>
                        <label for="option4">
                          <input type="checkbox" id="option4">
                          Sea Foods
                        </label>
                      </li>
                    </ul>
                  </div>
                </form>
              </div>

          </div>

        </div>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
          <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center border-primary">
              <h2 class="font-weight-light text-primary">Popular Categories</h2>
              <p class="color-black-opacity-5">Lorem Ipsum Dolor Sit Amet</p>
            </div>
          </div>

          <div class="row align-items-stretch">

              @if (count($categories) >= 1)
              @foreach ($categories as $cate)
              @php
              $tate = DB::table('rooms')->where('type','=',$cate->type_id)->count();
              @endphp
                  <div class="col-sm-6 col-md-4 mb-4 mb-lg-0 col-lg-2">
                      <a href="/rooms/type/{{ $cate->type_id }}" class="popular-category h-100">
                      <span class="icon"><span class={{ $cate->type_icon }}></span></span>
                      <span class="caption mb-2 d-block">{{ $cate->type_name }}</span>
                      <span class="number">{{ $tate }}</span>
                      </a>
                  </div>
              @endforeach

              @endif
          </div>
        </div>
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


  </body>
@endsection
