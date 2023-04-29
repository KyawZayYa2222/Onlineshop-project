@extends('user.layouts.main')

@section('mainsection')

<content>
    <!------------- payment section ------------>
    <div class="container d-flex justify-content-center align-items-center" id="content">
        <div class="d-flex flex-md-row flex-column my-3 bg-light rounded shadow payment_section">
            <div class="d-flex flex-column justify-content-center align-items-center payment_info rounded">
                <div class="text-center" style="backdrop-filter: blur(5px); width: 100%">
                    <p>Total</p>
                    <h4 class="total_cost">{{$totalCost}}$</h4>
                </div>
            </div>
            <div class="payment_form p-2">
                {{-- {{dd($method)}} --}}
                <img src="{{asset('user/img/'.$method.'.png')}}" height="50px" class="ms-3 mb-2">
                <div class="text-center py-4 sample_payment">
                    <h1>
                        <pre>This is<br>sample<br>payment page!</pre>
                    </h1>
                    <p>Here, payment form for real website but this is a sample website.</p>
                    <p>Please continue by clicking 'Order Now' or 'Cancel' buttons.</p>
                </div>
                <div class="mt-3 mb-2">
                    <form action="{{route('order')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-success bg-green border-0 float-end mx-1">Order Now</button>
                    </form>
                    {{-- <a href="#" class="btn btn-success bg-green border-0 float-end mx-1">Order Now</a> --}}
                    <a href="{{route('cartpage')}}" class="btn btn-secondary border-0 float-end mx-1">Cancel</a>
                </div>

            </div>
        </div>
    </div>
</content>

@endsection
