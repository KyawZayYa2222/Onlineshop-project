@extends('user.layouts.main')

@section('mainsection')

<content>
    <div class="container inline align-middle px-xl-5" id="content">
        <div class="row row-cols-lg-2 row-cols-1 mx-xl-5 mt-lg-5 mt-3 bg-light shadow rounded border">
            <div class="col-lg-5 d-flex justify-content-center align-items-center">
                <img src="{{asset('storage/'.$details->first()->image)}}" class="detail-img">
            </div>
            <div class="col-lg-7 py-2">
                <a href="{{url()->previous()}}" class="btn float-end"><i class="bi bi-arrow-return-left fs-20"></i></a><br>
                <h2 class="mb-3 w-75">{{$details->first()->name}}</h2>
                <div class="d-flex justify-content-between mb-md-4 mb-2">
                    <h2>{{$details->first()->price}}$</h2>
                    <a href="{{url('/review/'.$details->first()->id)}}" class="rating_page_link">
                        <div class="me-md-3 me-1 px-1 border rounded">
                            <div class="stars">
                                @if($details->first()->rate == 1)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($details->first()->rate == 2)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($details->first()->rate == 3)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($details->first()->rate == 4)
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1 yellow-star"></i>
                                    <i class="bi bi-star-fill me-1"></i>
                                @elseif ($details->first()->rate == 5)
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
                            <h6>{{count($rate)}} Reviews</h6>
                        </div>
                    </a>
                </div>
                <div class="product-desc-con">
                    <b style="font-style: italic;">Description</b>
                    <p>{{$details->first()->description}}</p>
                </div>
                <div class="row row-cols-sm-2 row-cols-1 mt-md-5 mt-3 my-3">
                    <div class="col">
                        {{-- add to cart  --}}
                        <form action="{{route('addtocart')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$details->first()->id}}">
                            <button type="submit" class="btn btn-success form-control mt-1 py-2">Add To Cart</button>
                        </form>
                    </div>
                    <div class="col">
                        {{-- add to wishlist  --}}
                        <form action="{{route('addtowishlist')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$details->first()->id}}">
                            <button type="submit" class="btn btn-primary form-control mt-1 py-2">Wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</content>

@endsection
