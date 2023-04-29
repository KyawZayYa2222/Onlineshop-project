@extends('user.layouts.main')

@section('mainsection')

<content>
    <div class="container py-3" id="content">
        <h2 class="pb-2  border-bottom">Reviews & Rating</h2>

        <a class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#reviewFormSupportedContent"
            aria-controls="reviewFormSupportedContent" aria-label="Toggle navigation">
                   <span class="btn btn-outline-danger rounded-pill">Write A Review</span>
        </a><br>

        <div class="collapse navbar-collapse" id="reviewFormSupportedContent">
          <div class="col col-md-8">
            <form action="{{route('review.create')}}" method="post">
                @csrf
                <b style="font-style: italic;">Choose stars</b>
                <div class="star-rating-con mb-2">
                    <input type="radio" checked name="star" class="in" id="s1" value="1">
                    <label for="s1"><i class="bi bi-star-fill star-btn" id="s1Btn"></i></label>

                    <input type="radio" name="star" class="in" id="s2" value="2">
                    <label for="s2"><i class="bi bi-star-fill star-btn" id="s2Btn"></i></label>

                    <input type="radio" name="star" class="in" id="s3" value="3">
                    <label for="s3"><i class="bi bi-star-fill star-btn" id="s3Btn"></i></label>

                    <input type="radio" name="star" class="in" id="s4" value="4">
                    <label for="s4"><i class="bi bi-star-fill star-btn" id="s4Btn"></i></label>

                    <input type="radio" name="star" class="in" id="s5" value="5">
                    <label for="s5"><i class="bi bi-star-fill star-btn" id="s5Btn"></i></label>
                </div>

                <b style="font-style: italic;">Review or Feedback</b>
                <textarea name="review" rows="6" class="form-control mb-3 mt-2" placeholder="Write something . ." required></textarea>
                <input type="hidden" name="product_id" value="{{$productData->first()->id}}">
                <button type="submit" class="btn btn-danger py-2">Upload Review</button>
            </form>
          </div>
        </div>

@if (session('alertsuccess'))
    <span class="alert alert-success" id="alert">{{session('alertsuccess')}}</span>
@elseif (session('alertfail'))
    <span class="alert alert-warning" id="alert">{{session('alertfail')}}</span>
@endif

        <h3 style="font-style: italic;" class="mt-3">{{$productData->first()->name}}</h3>

        <h3>
            {{-- Showing average rate  --}}
            ({{$productData->first()->rate}})Rate
        </h3>
        <div class="d-flex align-items-center star-rate-gp">
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-2 yellow-star"></i>
            <b>{{$starCount['fiveStar']}} reviews</b>
        </div>
        <div class="d-flex align-items-center star-rate-gp">
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-2"></i>
            <b>{{$starCount['fourStar']}} reviews</b>
        </div>
        <div class="d-flex align-items-center star-rate-gp">
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-2"></i>
            <b>{{$starCount['threeStar']}} reviews</b>
        </div>
        <div class="d-flex align-items-center star-rate-gp">
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-2"></i>
            <b>{{$starCount['twoStar']}} reviews</b>
        </div>
        <div class="d-flex align-items-center mb-5 star-rate-gp">
            <i class="bi bi-star-fill me-1 yellow-star"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-1"></i>
            <i class="bi bi-star-fill me-2"></i>
            <b>{{$starCount['oneStar']}} reviews</b>
        </div>

    <!--------- reviews section --------->

    {{-- {{dd($reviewData)}} --}}
    @foreach ($reviewData as $data)
    <div class="row mb-2">
        <div class="col">
            <div class="d-flex">
                <span class="rounded-circle" style="overflow:hidden;background: gray;">
                    <img src="{{asset('storage/'.$data->image)}}" width="40px" alt="">
                </span>
                <h3 class="ms-2">{{$data->name}}</h3>
            </div>
        </div>
        <div class="col">
            <div class="float-end me-2">
                <div class="d-flex align-items-center star-rate-gp">
                    @if($data->star_count == 1)
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                    @elseif ($data->star_count == 2)
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                    @elseif ($data->star_count == 3)
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1"></i>
                        <i class="bi bi-star-fill me-1"></i>
                    @elseif ($data->star_count == 4)
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1"></i>
                    @elseif ($data->star_count == 5)
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                        <i class="bi bi-star-fill me-1 yellow-star"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <p class="border-bottom pb-2 mb-3">{{$data->review}}</p>
    @endforeach

    </div>
</content>

@endsection
