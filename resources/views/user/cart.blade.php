@extends('user.layouts.main')

@section('mainsection')

<content>
    <section id="content" class="py-2">
        <div class="container custom-con">
            <h2 class="text-center mb-sm-4 mb-3">Shopping Cart</h2>
            <div class="row row-cols-md-2 row-cols-1">
                {{-- <div class="addcard-sm-con"></div> --}}
                <div class="col col-md-8">
                    @if (session('ordersuccess'))
                        <p class="alert alert-success" id="alert">{{session('ordersuccess')}}</p>
                    @endif
                    <table class="table text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Trash</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="td-hide-sm">Total</th>
                            </tr>
                        </thead>
                        <tbody id="cartlist-table">
                        {{-- ...  --}}
                        </tbody>
                    </table>
                </div>
                <div class="col col-md-4">
                    <div class="bg-light">
                        <h4 class="py-2 ps-2">Checkout Payment</h4>
                    </div>
                    <div class="d-flex px-1">
                        <p><b>Total item:</b></p><p class="ms-auto"><b id="item-count"></b></p>
                    </div>
                    <div class="d-flex px-1">
                        <p><b>Shipping fee:</b></p><p class="ms-auto"><b>free</b></p>
                    </div>
                    {{-- <div class="d-flex px-1">
                        <p><b>Total cost:</b></p><p class="ms-auto"><b>900$</b></p>
                    </div> --}}
                    <!-- payment choose section -->
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <p>Choose payment methods</p>
                        <div class="d-flex px-1 align-items-center">
                            <label class="radio-label">
                                <img src="{{asset('user/img/paypal.png')}}" height="40px">
                                <input type="radio" name="payment" value="paypal" class="payments" checked>
                            </label>
                            <label class="radio-label">
                                <img src="{{asset('user/img/master.png')}}" height="40px">
                                <input type="radio" name="payment" value="master" class="payments">
                            </label>
                            <label class="radio-label">
                                <img src="{{asset('user/img/visa.png')}}" height="40px">
                                <input type="radio" name="payment" value="visa" class="payments">
                            </label>
                        </div>
                        <button type="submit" class="checkout-btn py-3 mt-3 fs-18 bg-green">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</content>

@endsection


@section('Javascripts')

<script type="text/javascript">
$(document).ready(function() {
    $fetchData = '';
    $fetchDataMobile = '';
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/cart/ajax/list',
        success: function(response) {
            if(response.length === 0) {
                $fetchData = '<tr><td colspan="5" class="py-4 align-middle">No product have to checkout.</td></tr>';
                $('#cartlist-table').append($fetchData);
            }else {
                fetchData(response);
                $('.p-count-input').inputSpinner();
            }
            $('#item-count').html(response.length);

            // product count update
            $(':input[type=number]').change(function() {
                var id = $(this).attr('data-cart-id');
                var count = $(this).val();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/ajax/list',
                    data: {'status': 'update', 'cartId': id, 'productCount': count},
                })
            });
        }
    })

    // fetching data
    function fetchData(response) {
        $('#cartlist-table').empty();
        for (let i = 0; i < response.length; i++) {
            $fetchData = `
                <tr class="align-middle">
                    <td><a href="http://127.0.0.1:8000/cart/delete/`+response[i].id+`" class="text-danger remove-btn"><i class="bi bi-trash3"></i></a></td>
                    <td>
                        <img src="http://127.0.0.1:8000/storage/`+response[i].image+`" alt="img">
                    </td>
                    <td>`+response[i].price+`$</td>
                    <td style="width: 150px">
                        <input type="number" name="p-count" min="1" max="10" step="1" data-cart-id="`+response[i].id+`" value="`+response[i].product_count+`" class="p-count-input">
                    </td>
                    <td class="td-hide-sm">`+Math.floor(response[i].product_count * response[i].price)+`$</td>
                </tr>
            `;
            $('#cartlist-table').append($fetchData);
        }
    }

})
</script>

@endsection

{{-- <td>`+Math.floor(response[i].product_count * response[i].price)+`$</td> --}}

{{-- $('.remove-btn').click(function() {
    var id = $(this).attr('data-cart-id');
    console.log('delete');
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/cartlist/ajax',
        data: {'status': 'delete', 'cartId': id},
        success: function(response) {
            $('#cartlist-table').empty();
            fetchData(response);
            $('.p-count-input').inputSpinner();
        }
    })
}); --}}
