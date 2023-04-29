@extends('user.layouts.main')

@section('mainsection')

<content>
    <section id="content" class="py-2">
        <div class="container custom-con">
            <h2 class="text-center mb-3">My Wishlist</h2>
            <table class="table text-center">
                <thead>
                    <tr class="table-light">
                        <th>Trash</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Cart</th>
                    </tr>
                </thead>
                <tbody id="wishlist-table">
                    {{-- ... --}}
                </tbody>
            </table>
        </div>
    </section>
</content>

@endsection

@section('Javascripts')
<script type="text/javascript">

$fetchData = '';
$.ajax({
    type: 'get',
    url: 'http://127.0.0.1:8000/wishlist/ajax/list',
    success: function(response) {
        if(response.length === 0) {
            emptyFetchData();
        }else {
            fetchData(response);
        }


        // deleting
        $('.remove-btn').click(function() {
            var wishId = $(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/wishlist/ajax/list',
                data: {'status': 'delete', 'wish_id': wishId},
                success: function(response) {
                    if(response.length === 0) {
                        emptyFetchData();
                    }else {
                        $('#wishlist-table').empty();
                        fetchData(response);
                    }
                }
            })
        })

        // Adding to cart
        $('.add-cart-btn').click(function() {
            var productId = $(this).attr('data-product-id');
            var wishId = $(this).attr('data-wish-id');
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/wishlist/ajax/list',
                data: {'status': 'addtocart', 'product_id': productId, 'wish_id': wishId},
                success: function(response) {
                    if(response.length === 0) {
                        emptyFetchData();
                    }else {
                        $('#wishlist-table').empty();
                        fetchData(response);
                    }
                }
            })
        })
    },
})

function fetchData(response) {
    for (let i = 0; i < response.length; i++) {
        $fetchData = `
            <tr class="align-middle">
                <td><button class="remove-btn" data-id="`+response[i].id+`"><i class="bi bi-trash3 text-danger"></i></button></td>
                <td>
                    <img src="http://127.0.0.1:8000/storage/`+response[i].image+`" alt="img">
                </td>
                <td>`+response[i].price+`$</td>
                <td align="center">
                    <button class="lg-cardbtn px-3 py-1 add-cart-btn" data-wish-id="`+response[i].id+`" data-product-id="`+response[i].product_id+`">Add To Cart</button>
                    <button class="sm-cardbtn btn btn-sm btn-light bg-green add-cart-btn" data-wish-id="`+response[i].id+`" data-product-id="`+response[i].product_id+`"><span class="text-white">Add</span></button>
                </td>
            </tr>
        `;
        $('#wishlist-table').append($fetchData);
    }
}

function emptyFetchData() {
    $fetchData =`
        <tr class="align-middle" align="center">
            <td colspan="4">No product have in your wishlist.</td>
        </tr>
    `;
    $('#wishlist-table').html($fetchData);
}

</script>
@endsection
