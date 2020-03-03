@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@php
$usertype = Auth::user()->is_admin;
@endphp
<body>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                columnDefs: [
                    {
                        targets: [ 0, 1, 2 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });
            var chet  = "<?php echo $usertype ?>";
            if( chet == 1){
                $('#example tbody').on('click', 'tr', function () {
                    //alert("hey admin");
                    var mum = $('#example').DataTable().row(this).data();
                    var num = mum[12];
                    /*Swal.fire({
                        title: 'Do you want to delete this file?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                      }).then((result) => {
                        if (result.value) {
                          Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                        }
                      })*/
                })
            }else{
                $('#example tbody').on('click', 'tr', function () {
                    //alert($('#example').DataTable().row(this).data());
                    var mum = $('#example').DataTable().row(this).data();
                    console.log(mum[4]);
                    var num = mum[0];
                    var gusts = mum[4];
                    window.open("/invoice/" + num +"/"+gusts, "_self");
                    //console.log($('#example').DataTable().row(this).data());
                })
            }
        } );
    </script>

    <div class="site-section">
        <div class="container">
            <div style="width:100%">
                <table id="example" class="mdl-data-table " style="width:100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Booked by</th>
                        <th>Phone</th>
                        <th>Guests</th>
                        <th>Children</th>
                        <th>Adults</th>
                        <th>Price</th>
                        <th>Location</th>
                        <th>Condition</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Room id</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($logs as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->name}}</td>
                            <td>{{$post->phone}}</td>
                            <td>{{$post->no_guests}}</td>
                            <td>{{$post->children}}</td>
                            <td>{{$post->adults}}</td>
                            <td>{{$post->price}}</td>
                            <td>{{$post->location}}</td>
                            <td>{{$post->condition}}</td>
                            <td>{{$post->start_time}}</td>
                            <td>{{$post->end_time}}</td>
                            <td>{{$post->room_id}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
@endsection
