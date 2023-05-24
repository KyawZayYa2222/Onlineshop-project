@extends('user.layouts.main')

@section('mainsection')

<content>
    <!-- discount section  -->
    <section id="discount">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="container py-3">
                    <div class="row pt-sm-5 pt-3">
                        <div class="col col-sm-7 d-flex pt-xl-5 pb-2">
                            <div class="mx-auto slide-txt">
                                <h1><span style="color: rgb(0, 165, 44);">8%</span> Discount</h1>
                                <h2 class="mb-lg-4 mb-md-2">Smart Watch</h2>
                                <a href="#" class="shop-btn1 px-md-5 px-3 py-md-2 py-1">Shop Now</a>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <img src="{{asset('user/img/watch.png')}}" class="d-block w-50" alt="">
                        </div>
                    </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="container py-3">
                    <div class="row pt-sm-5 pt-3">
                        <div class="col col-sm-7 d-flex pt-xl-5 pb-2">
                            <div class="mx-auto slide-txt">
                                <h1><span style="color: rgb(0, 165, 44);">8%</span> Discount</h1>
                                <h2 class="mb-lg-4 mb-md-2">16 inches width LED Tv</h2>
                                <a href="#" class="shop-btn1 px-md-5 px-3 py-md-2 py-1">Shop Now</a>
                            </div>
                        </div>
                        <div class="col col-sm-5">
                            <img src="{{asset('user/img/LCD_Tv.png')}}" class="d-block w-50" alt="">
                        </div>
                    </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="container py-3">
                    <div class="row pt-sm-5 pt-3">
                        <div class="col col-sm-7 d-flex pt-xl-5 pb-2">
                            <div class="mx-auto slide-txt">
                                <h1><span style="color: rgb(0, 165, 44);">8%</span> Discount</h1>
                                <h2 class="mb-lg-4 mb-md-2">Cannon M50 Mark-II black with kit lens</h2>
                                <a href="#" class="shop-btn1 px-md-5 px-3 py-md-2 py-1">Shop Now</a>
                            </div>

                        </div>
                        <div class="col col-sm-5">
                            <img src="{{asset('user/img/Cannon_M50 Mark ll Camera.png')}}" class="d-block w-50" alt="">
                        </div>
                    </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="container py-3">
                    <div class="row pt-sm-5 pt-3">
                        <div class="col col-sm-7 d-flex pt-xl-5 pb-2">
                            <div class="mx-auto slide-txt">
                                <h1><span style="color: rgb(0, 165, 44);">4%</span> Discount</h1>
                                <h2 class="mb-lg-4 mb-md-2">Kitchen Pan</h2>
                                <a href="#" class="shop-btn1 px-md-5 px-3 py-md-2 py-1">Shop Now</a>
                            </div>

                        </div>
                        <div class="col col-sm-5">
                            <img src="{{asset('user/img/kitchen-pan.png')}}" class="d-block w-50" alt="">
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev fs-20" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <i class="bi bi-chevron-left  " aria-hidden="true"></i>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next fs-20" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <i class="bi bi-chevron-right" aria-hidden="true"></i>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>
    <!-- end  -->

    <!-- new product section  -->
    <section>
        <div class="container">
            <h2 class="mt-4 mb-4" style="font-family: 'Roboto', sans-serif;">Newest Products</h2>

            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2" align="center">
                @foreach ($productData as $data)
                    <div class="col mb-md-4 mb-3">
                        <div class="card p-card">
                                <div class="card-head pcard-head">
                                    <img src="{{asset('storage/'.$data->image)}}" class="card-img-top" alt="...">
                                <a href="{{route('productdetail', $data->id)}}">Details</a>
                            </div>
                            <div class="card-body pt-1 pb-2" align="left">
                              <div class="stars">
                                @if($data->rate == 1)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($data->rate == 2)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($data->rate == 3)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($data->rate == 4)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($data->rate == 5)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                @else
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                @endif
                              </div>
                              <p class="fs-18 mt-0 mb-1 font-weight-bold text-truncate">{{$data->name}}</p>
                              <p class="lh-1 py-0 mt-0 mb-1 truncateMe desc"><em>{{$data->description}}</em></p>
                              <p class="fs-18 mb-1"><b>{{$data->price}}$</b></p>
                              <button class="custom-btn addcard" onclick="addToCart({{$data->id}})"><span id="lg-btn">Add To Card</span><span id="sm-btn">Add<i class="bi bi-cart-plus-fill"></i></span></button>
                              <button type="submit" class="custom-btn wishlist" onclick="addToWishlist({{$data->id}})"><span id="lg-btn"><i class="bi bi-heart-fill"></i>&nbsp;whilist</span><span id="sm-btn"><i class="bi bi-heart-fill"></i></span></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{route('productpage')}}" id="seemore-btn">See More Products</a>
        </div>
    </section>
    <!-- end  -->

    {{-- Modal  --}}
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- ...  --}}
    </div>

    <!-- service section  -->
    <section class="container-fluid">
      <!-- <center> -->
        <h2 class="mt-md-3 mt-5 text-center">Our Services</h2>
        <div class="row mt-md-5 my-3" align="center">
            <div class="col">
                <div class="service-card" align="center">
                    <div class="icon">
                        <i class="bi bi-question-lg"></i>
                    </div>
                    <h3>Customer Support</h3>
                    <span><b>Need Assistence ?</b></span>
                    <p id="text" class="lh-sm">We are open for 24-hours for customer support service.
                        if you want to know something, ask us whatever from contact page
                        . Our customer support team will answer things you want to know.
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="service-card" align="center">
                    <div class="icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h3>Secure Payment</h3>
                    <span><b>Safe & fast</b></span>
                    <p id="text" class="lh-sm">
                        Our payment system is secure and we used high technical systems and use secured payment services
                        on the world like paypal and credit-cards.
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="service-card" align="center">
                    <div class="icon">
                        <i class="bi bi-water"></i>
                    </div>
                    <h3>Free shipping</h3>
                    <span><b>Over $100 & above</b></span>
                    <p id="text" class="lh-sm">
                        You can get free shipping for using $100 & above on our product and
                        We wil delivery to you for free wherever you are inside or outside of the country.
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="service-card" align="center">
                    <div class="icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3>Fast Delivery</h3>
                    <span><b>Fast and secure.</b></span>
                    <p id="text" class="lh-sm">
                        We deliver with fast and famous delivery company on local or oversea. On local you should
                        receive in 4 or 5 day or on oversea or other countries you should in a few week or more depending on you location.
                    </p>
                </div>
            </div>
        </div>
    </center>
    </section>
    <!-- end  -->
</content>

@endsection

@section('Javascripts')
<script src="{{asset('user/js/product-ajax.js')}}"></script>
@endsection
