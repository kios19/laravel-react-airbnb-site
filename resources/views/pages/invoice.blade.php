@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://js.elypa.io"></script>
<link href="{{ asset('css/button.css') }}" rel="stylesheet">


<script>
const globe = require('../globals/globals.json')
        function Payme(){
            var price = "<?php echo $poc[0]->price * $no ?>"
            var phone = "<?php echo $poc[0]->phone  ?>"
            const currency = 'USD';

            const close = window.dooglepay({
                key: "ET_F36SPTZ-AMKMMZR-NTB4WDY-38A66XP",
                amount: price * 100, // $100 USD
                currency: "KES" ,
                methods: ["card","mpesa"],
                // reference: '1234567890',
                // accountId: 0,
                phone: phone,
                // email: 'test@example.com',
                onCharge(transactionId) {
                    // one can send the transactionId to the backend for verification
                    // via the verify api, but its strongly recommended
                    // to perform transaction verifications
                    // via the webhook API
                    console.log("charged", transactionId);
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------121081417250730563726272");

                    var formdata = new FormData();
                    formdata.append("rid", "1");

                    var requestOptions = {
                    method: 'POST',
                    //headers: myHeaders,
                    body: formdata,
                    redirect: 'follow'
                    };

                    fetch(globe.paid_url, requestOptions)
                    .then(response => response.text())
                    .then(result => console.log(result))
                    .catch(error => console.log('error', error));

                    // post transaction ops
                    close(); // close the modal
                },
                onError(e) {
                    // charge error
                    console.error("charge error", e);
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------318771058869086087130413");

                    var formdata = new FormData();
                    formdata.append("rid", "1");
                    formdata.append("error", e);

                    var requestOptions = {
                    method: 'POST',
                    //headers: myHeaders,
                    body: formdata,
                    redirect: 'follow'
                    };

                    fetch(globe.error_url, requestOptions)
                    .then(response => response.text())
                    .then(result => console.log(result))
                    .catch(error => console.log('error', error));
                },
                onCancel() {
                    // user cancelled transaction
                    var myHeaders = new Headers();
                    myHeaders.append("Content-Type", "multipart/form-data; boundary=--------------------------275856061850697260959412");

                    var formdata = new FormData();
                    formdata.append("rid", "1");

                    var requestOptions = {
                    method: 'POST',
                    //headers: myHeaders,
                    body: formdata,
                    redirect: 'follow'
                    };

                    fetch(globe.cancelled_url, requestOptions)
                    .then(response => response.text())
                    .then(result => console.log(result))
                    .catch(error => console.log('error', error));
                }
            });
      }
</script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-md-6">
                            <img src="https://image.flaticon.com/icons/svg/438/438110.svg" height="65px">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #550</p>
                            <p class="text-muted">Due to: 4 Dec, 2019</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{ $poc[0]->name }}</p>
                            <p>{{ $poc[0]->email }}</p>
                            <p class="mb-1">{{ $poc[0]->phone }}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>
                            <!--p class="mb-1"><span class="text-muted">Name: </span>{{ Auth::user()->name}}</p-->
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Room</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Description</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Guests</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Unit Cost</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $poc[0]->id }}</td>
                                        <td>{{ $poc[0]->title }}</td>
                                        <td>{{ $poc[0]->description }}</td>
                                        <td>{{ $no }}</td>
                                        <td>ksh{{ $poc[0]->price }}</td>
                                        <td>ksh{{ $poc[0]->price * $no }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <!--div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">$234,234</div>
                        </div-->
                        <!--div class="py-3 px-5 text-right">
                            <div><Button class="btn-epic" onclick="Payme()" >make Payment</Button></div>
                        </div-->

                        <div class="py-3 px-5 text-right">
                            <div class="wrapper" onclick="Payme()">
                                <a class="cta" href="#">
                                  <span>Pay</span>
                                  <span>
                                    <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                      <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                        <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                        <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                      </g>
                                    </svg>
                                  </span>
                                </a>
                              </div>
                        </div>

                        <!--div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">10%</div>
                        </div-->

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">ksh {{ $poc[0]->price * $no }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

</div>

@endsection
