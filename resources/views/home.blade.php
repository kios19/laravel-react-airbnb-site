@extends('layouts.app')

@section('content')
<script type="text/javascript">

    function submitForm(event){
        event.preventDefault();
        loc = document.getElementById("loca").value;
        ripe = document.getElementById("typis").value;
        search = document.getElementById("rain").value;

        window.location.replace("/search/"+search+"/"+loc+"/"+ripe);
        //console.log("/search/"+search+"/"+loc+"/"+ripe)
    }
</script>
 <div class="site-blocks-cover overlay" style="background-image: url(images/hero_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10">


            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1 data-aos="fade-up">Find Nearby <span class="typed-words"></span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Explore top-rated attractions, activities and more!</p>
              </div>
            </div>

            <div class="form-search-wrap p-2" data-aos="fade-up" data-aos-delay="200">
              <form method="post" onsubmit="submitForm(event)">
                <div class="row align-items-center">
                  <div class="col-lg-12 col-xl-4 no-sm-border border-right">
                    <input id="rain" type="text" class="form-control" placeholder="What are you looking for?">
                  </div>
                  <div class="col-lg-12 col-xl-3 no-sm-border border-right">
                    <div class="wrap-icon">
                        <span class="icon"><span class="icon-room"></span></span>
                      <select  id="loca" name="event_editsa" class="form-control">
                        @foreach($locations as $event)
                            <option value="{{$event->lid}}">{{$event->location_name}}</option>
                        @endforeach
                    </select>
                    </div>

                  </div>
                  <div class="col-lg-12 col-xl-3">
                    <div class="select-wrap">
                      <span class="icon"><span class="icon-keyboard_arrow_down"></span></span>
                      <select id="typis" name="event_edit" class="form-control">
                            @foreach($categories as $event)
                                <option value="{{$event->type_id}}">{{$event->type_name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-lg-12 col-xl-2 ml-auto text-right">
                    <input type="submit" class="btn btn-primary" value="Search">
                  </div>

                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>



    <div class="site-section" data-aos="fade">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Most Visited Places</h2>
            <p class="color-black-opacity-5">top booked spaces</p>
          </div>
        </div>

        <div class="row">



          @if (count($rooms) >= 1)
          @foreach ($rooms as $room)
              <div class="col-md-6 mb-4 mb-lg-0 col-lg-4">
              <div class="listing-item">
                  <div class="listing-image">
                    <img src='/uploads/{{ $room->image1 }}' alt="Image" class="img-fluid">
                  </div>
                  <div class="listing-item-content">

                    <a href="#" class=""><span class="banner">{{ $room->price }}/- per </span></a>
                    <a class="px-3 mb-3 category" href="#">{{ $room->type_name }}</a>
                    <h2 class="mb-1"><a href="#">{{ $room->title }}</a></h2>
                    <span class="address">{{ $room->location_name }}</span>
                  </div>
              </div>
            </div>
          @endforeach

          @endif

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

    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <img src="images/img_1.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-md-5 ml-auto">
            <h2 class="text-primary mb-3">Why Us</h2>
            <p>When you own a residential investment property you can either manage the property yourself or you can use a real estate agent to manage it for you</p>
            <p class="mb-4">If you decide that using a real estate agent to manage your property is preferable, then Tibit is more than a rent collector, offering a comprehensive property management service</p>

            <ul class="ul-check list-unstyled success">
              <li>Showing prospective tenants through the property</li>
              <li>Receipt of applications and screening of appropriate tenants</li>
              <li>Payment of accounts</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">

        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Testimonials</h2>
          </div>
        </div>

        <div class="slide-one-item home-slider owl-carousel">
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid mb-3">
                <p>John Smith</p>
              </figure>
              <blockquote>
                <p>&ldquo;"Great job, I will definitely be ordering again! This is simply unbelievable! Great job, I will definitely be ordering again! Room is awesome!".&rdquo;</p>
              </blockquote>
            </div>
          </div>
          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid mb-3">
                <p>John wayne</p>
              </figure>
              <blockquote>
                <p>&ldquo;"It's really wonderful. Man, this thing is getting better and better as I learn more about it. I could probably go into sales for you. I love rental.".&rdquo;</p>
              </blockquote>
            </div>
          </div>

          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_4.jpg" alt="Image" class="img-fluid mb-3">
                <p>Robert Spears</p>
              </figure>
              <blockquote>
                <p>&ldquo;"I would also like to say thank you to all your staff. I am really satisfied with my bookings. It fits our needs perfectly. Thanks for the great service.".&rdquo;</p>
              </blockquote>
            </div>
          </div>

          <div>
            <div class="testimonial">
              <figure class="mb-4">
                <img src="images/person_5.jpg" alt="Image" class="img-fluid mb-3">
                <p>Chrstine Acie</p>
              </figure>
              <blockquote>
                <p>&ldquo;"I am so pleased with this product. It's exactly what I've been looking for. I couldn't have asked for more than this".&rdquo;</p>
              </blockquote>
            </div>
          </div>

        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Q tips</h2>
            <p class="color-black-opacity-5">See Our Daily News &amp; Updates</p>
          </div>
        </div>
        <div class="row mb-3 align-items-stretch">
          <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Why Rent a Property</a></h2>
              <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#"></a></div>
              <p>When renting a rental, you might have the opportunity to stay in a local neighborhood, get insider knowledge about your destination, see your destination through the eyes of a local, and get a small glimpse of how locals live. Dine where locals dine, feel more connected to where you are traveling too, go off the beaten path, talk and have fun with a local. There is no reason to settle for the cookie cutter hotel experience when you can trade it in for a more local and authentic experience.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 mb-4 mb-lg-4">
            <div class="h-entry">
              <img src="images/hero_1.jpg" alt="Image" class="img-fluid">
              <h2 class="font-size-regular"><a href="#">Why List Your Property</a></h2>
              <div class="meta mb-4">by Theresa Winston <span class="mx-2">&bullet;</span> Jan 18, 2019 at 2:00 pm <span class="mx-2">&bullet;</span> <a href="#"></a></div>
              <p>We appreciate that selling your property can sometimes be a stressful experience.
                At Rudy Yonson Real Estate we are committed to offering our Vendors an
                extraordinary level of service, designed to ensure that the sale of
                your property is a happy & rewarding event</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Frequently Ask Question</h2>
            <p class="color-black-opacity-5">Lorem Ipsum Dolor Sit Amet</p>
          </div>
        </div>


        <div class="row justify-content-center">
          <div class="col-8">
            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1" class="accordion-item h5 d-block mb-0">How to list my item?</a>

              <div class="collapse" id="collapse-1">
                <div class="pt-2">
                  <p class="mb-0">Create a tibit account, log in to your account with your cridentials and the "create Listing" option will be available from the navigation bar.</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-4" role="button" aria-expanded="false" aria-controls="collapse-4" class="accordion-item h5 d-block mb-0">Is this available in my country?</a>

              <div class="collapse" id="collapse-4">
                <div class="pt-2">
                  <p class="mb-0">Tibit is currenty available in Kenya</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2" class="accordion-item h5 d-block mb-0">Is it free?</a>

              <div class="collapse" id="collapse-2">
                <div class="pt-2">
                  <p class="mb-0"> Yes the service is completely free</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-3" role="button" aria-expanded="false" aria-controls="collapse-3" class="accordion-item h5 d-block mb-0">How the system works?</a>

              <div class="collapse" id="collapse-3">
                <div class="pt-2">
                  <p class="mb-0">You post your listing and you will be notified when client book your lising.</p>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class="py-5 bg-primary">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 class="mb-2 text-white">Lets get started. Create your account</h2>
            <!--p class="mb-4 lead text-white-opacity-05">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, fugit?</p-->
            <p class="mb-0"><a href="/register" class="btn btn-outline-white text-white btn-md font-weight-bold">Sign Up</a></p>
          </div>
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



  <script src="js/typed.js"></script>
            <script>
            var typed = new Typed('.typed-words', {
            strings: ["Appartments"," Rooms"," Hotels", " Houses"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
            });
            </script>

  <script src="js/main.js"></script>

  </body>
</html>
@endsection
