$fetchData = '';

$.truncateMe({
    elem:'.truncateMe',
    words:false,
    trimTo: 50
});

// Category filter
$('.category-check').click(function() {
    $('#product-con-org').css('display', 'none');
    $('.category-check').removeClass('active-check');
    $fetchData='';
    categoryId = $(this).attr('id');
    $(this).addClass('active-check');
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/product/ajax",
        data: {status : 'category', id: categoryId},
        success: function(response) {
            if(response== '') {
                emptyFetchData();
            }
            fetchData(response);
        }
    })
})

// Price filter
$("input[name='price']:radio").change(function() {
    $('#product-con-org').css('display', 'none');
    $fetchData = '';
    var priceRange = $("input[name='price']:radio:checked").val();
    $.ajax({
        type: "get",
        url: "http://127.0.0.1:8000/product/ajax",
        data: {status : 'price', range: priceRange},
        success: function(response) {
            if(response== '') {
                emptyFetchData();
            }
            fetchData(response);
        }
    })
})

// Sorting
$('#sort-btn').change(function() {
    $fetchData = '';
    var sort = $(this).val();
    if(sort==='all') {
        $.ajax({
        type: 'get',
        url: "http://127.0.0.1:8000/product/ajax",
        success: function(response) {
            if(response== '') {
                emptyFetchData();
            }
            fetchData(response);
        }
        })
    }else if(sort==='desc') {
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/product/ajax",
            data: {status: 'desc'},
            success: function(response) {
                if(response== '') {
                    emptyFetchData();
                }
                fetchData(response);
            }
        })
    }else if(sort==='asc') {
        $.ajax({
            type: "get",
            url: "http://127.0.0.1:8000/product/ajax",
            data: {status: 'asc'},
            success: function(response) {
                if(response== '') {
                    emptyFetchData();
                }
                fetchData(response);
            }
        })
    }

})

// fetching data functionf
var oneStar = `
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            `;
var twoStar = `
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            `;
var threeStar = `
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
            `;
var fourStar = `
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill"></i>
            `;
var fiveStar = `
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
                <i class="bi bi-star-fill yellow-star"></i>
            `;

function fetchData(response) {
    for (let i = 0; i < response.length; i++) {
            $fetchData += `
                <div class="col mb-md-4 mb-3">
                    <div class="card p-card">
                            <div class="card-head pcard-head">
                                <img src="http://127.0.0.1:8000/storage/`+response[i].image+`" class="card-img-top" alt="...">
                            <a href='/product-detail/`+response[i].id+`'>Details</a>
                        </div>
                        <div class="card-body pt-1 pb-2" align="left">
                          <div class="stars">
                          .${
                            response[i].rate == 1 ? oneStar:
                            response[i].rate == 2 ? twoStar:
                            response[i].rate == 3 ? threeStar:
                            response[i].rate == 4 ? fourStar:
                            response[i].rate == 5 ? fiveStar:
                            `<i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>`
                          }.
                          </div>
                          <p class="fs-18 mt-0 mb-1 font-weight-bold text-truncate">`+response[i].name+`</p>
                          <p class="lh-1 py-0 mt-0 mb-1 truncateMe desc"><em>`+response[i].description+`</em></p>
                          <p class="fs-18 mb-1"><b>`+response[i].price+`$</b></p>
                          <button class="custom-btn addcard" onclick="addToCart(`+response[i].id+`)"><span id="lg-btn">Add To Card</span><span id="sm-btn">Add<i class="bi bi-cart-plus-fill"></i></span></button>
                          <button type="submit" class="custom-btn wishlist" onclick="addToWishlist(`+response[i].id+`)"><span id="lg-btn"><i class="bi bi-heart-fill"></i>&nbsp;whilist</span><span id="sm-btn"><i class="bi bi-heart-fill"></i></span></button>
                        </div>
                    </div>
                </div>
            `;
    }
    $('#product-con').html($fetchData);
    // text turncate
    $.truncateMe({
        elem:'.truncateMe',
        words:false,
        trimTo: 50
    });
}

// Add to Cart
function addToCart(id) {
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/cart/ajax',
        data: {'product_id': id},
        error: function() {
            window.location = 'http://127.0.0.1:8000/login';
        },
        success: function(response) {
            $cartModal = `
            <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Added to Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <table class="table table-striped">
                  <tr>
                      <th colspan="2">Product</th>
                      <th>Count</th>
                      <th>Cost</th>
                  </tr>
                  <tr class="align-middle">
                      <td><img src="http://127.0.0.1:8000/storage/`+response[0].image+`" width="90px" alt=""></td>
                      <td>`+response[0].name+`</td>
                      <td>`+response[0].product_count+`</td>
                      <td>`+Math.floor(response[0].product_count * response[0].price)+`$</td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <a href="http://127.0.0.1:8000/cart" class="btn bg-green btn-secondary border-0 py-2 px-3">Go To Cart</a>
              </div>
            </div>
            </div>
            `;
            $('#modal').html($cartModal).modal('show');
        }
    })
}

// Add to Wishlist
function addToWishlist(id) {
    $.ajax({
        type: 'get',
        url: 'http://127.0.0.1:8000/wishlist/ajax',
        data: {'product_id': id},

        success: function(response) {
            if('status' in response) {
                alert('You already added this product to your wishlist.');
            }else {
                $wishlistModal = `
                    <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Added to Wishlist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table table-striped">
                          <tr>
                              <th></th>
                              <th>Product</th>
                              <th>Price</th>
                          </tr>
                          <tr class="align-middle">
                              <td><img src="http://127.0.0.1:8000/storage/`+response[0].image+`" width="90px" alt=""></td>
                              <td>`+response[0].name+`</td>
                              <td>`+response[0].price+`$</td>
                          </tr>
                        </table>
                      </div>
                      <div class="modal-footer">
                        <a href="http://127.0.0.1:8000/wishlist" class="btn btn-primary border-0 py-2 px-3">Go To Wishlist</a>
                      </div>
                    </div>
                    </div>
                    `;
                $('#modal').html($wishlistModal).modal('show');
            }
        },
    })
}

// Empty fetch data
function emptyFetchData() {
    $fetchData=`
        <div class="container mt-3">
            <h2 class="text-secondary text-center">No product to show yet!</h2>
        </div>`;
}

