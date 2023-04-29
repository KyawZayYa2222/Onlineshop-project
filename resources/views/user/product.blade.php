@extends('user.layouts.main')

@section('mainsection')

<content class="d-flex flex-xl-row flex-column bg-light py-4">
    <!----------- product filter section -------------->
        <aside class="ms-sm-4 mx-2 border-end">
            <div class="px-md-3 mb-2 navbar-expand-xl">
                <div class="d-flex pb-1 mb-2 border-bottom">
                    <h4>Product Filter</h4>
                    <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="bi bi-chevron-down btn btn-light border ms-4"></span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="sidebarSupportedContent">
                    <div style="display:block">
                        <h6>By Category</h6>
                        <div class="p-2 pe-0 mb-2 category-con">
                        @if ($category)
                            @foreach ($category as $data)
                            <span id="{{$data->id}}" class="category-check">{{$data->name}}</span>
                            @endforeach
                        @endif
                        </div>
                        <h6>By Price</h6>
                        <div class="d-flex flex-column price-radio-gp">
                            <label for="p1"><input type="radio" name="price" id="p1" value="any"> Any price</label>
                            <label for="p2"><input type="radio" name="price" id="p2" value="<50"> Under 50$</label>
                            <label for="p3"><input type="radio" name="price" id="p3" value="50-200"> 50$ - 200$</label>
                            <label for="p4"><input type="radio" name="price" id="p4" value="200-500"> 200$ - 500$</label>
                            <label for="p5"><input type="radio" name="price" id="p5" value="500-900"> 500$ - 900$</label>
                            <label for="p6"><input type="radio" name="price" id="p6" value=">900"> 900$ & Above</label>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

    <!--------------- product sections ----------------->
        <main class="mt-3 container-fluid">
            <span class="float-end">
                <form action="">
                    <select name="sort" class="form-select" id="sort-btn">
                        <option value="">Sort by</option>
                        <option value="all">Show all</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </form>
            </span><br><br>

    {{-- cart model  --}}
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
{{-- ...  --}}
  </div>

            {{-- product section  --}}
          <div id="product-con-org">
            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2" align="center">
                @foreach ($product as $data)
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
            {{$product->links()}}
          </div>

            <div class="row row-cols-md-4 row-cols-sm-3 row-cols-2" align="center" id="product-con"></div>
        </main>
    </content>

@endsection

@section('Javascripts')
<script src="{{asset('user/js/product-ajax.js')}}"></script>

@endsection
