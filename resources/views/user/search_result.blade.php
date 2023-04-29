@extends('user.layouts.main')

@section('mainsection')

<content>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- ...  --}}
    </div>

    <div class="container my-3" id="content">
        <h2 class="text-secondary">Results</h2>
        @if ($results != null)
            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2 pt-4" align="center">
                @foreach ($results as $result)
                <div class="col mb-md-4 mb-3">
                    <div class="card p-card">
                            <div class="card-head pcard-head">
                                <img src="{{asset('storage/'.$result->image)}}" class="card-img-top" alt="...">
                            <a href="{{url('/product-detail/'.$result->id)}}">Details</a>
                        </div>
                        <div class="card-body pt-1 pb-2" align="left">
                          <div class="stars">
                            @if ($result->rate == 1)
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            @elseif ($result->rate == 2)
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            @elseif ($result->rate == 3)
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            @elseif ($result->rate == 4)
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill"></i>
                            @elseif ($result->rate == 5)
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            <i class="bi bi-star-fill yellow-star"></i>
                            @else
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            @endif
                          </div>
                          <p class="fs-18 mt-0 mb-1 font-weight-bold text-truncate">{{$result->name}}</p>
                          <p class="lh-1 py-0 mt-0 mb-1 truncateMe desc"><em>{{$result->description}}</em></p>
                          <p class="fs-18 mb-1"><b>{{$result->price}}$</b></p>
                          <button class="custom-btn addcard" data-request-id="{{$result->id}}"><span id="lg-btn">Add To Card</span><span id="sm-btn">Add<i class="bi bi-cart-plus-fill"></i></span></button>
                          <button type="submit" class="custom-btn wishlist" data-request-id="{{$result->id}}"><span id="lg-btn"><i class="bi bi-heart-fill"></i>&nbsp;whilist</span><span id="sm-btn"><i class="bi bi-heart-fill"></i></span></button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center pt-5">
                <h2 class="text-secondary">Oops!</h2>
                <h3 class="text-secondary" style="font-style: italic">No product have such as you find.</h3>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
            </div>
            @endif
    </div>
</content>

@endsection

@section('Javascripts')
<script src="{{asset('user/js/product-ajax.js')}}"></script>
@endsection
