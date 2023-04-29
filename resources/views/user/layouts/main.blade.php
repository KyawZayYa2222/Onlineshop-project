<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meron Olineshop</title>

    <link href="{{asset('admin/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('user/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('user/css/lightslider.css')}}">

</head>
<body>
    <header class="bg-green">
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <a href="{{route('welcome')}}" class="logo-con">
                        <div class="d-flex logo">
                            <img src="{{asset('user/img/meron-logo3.png')}}" width="49px" height="49px">
                            <h1 class="ms-1">Meron</h1>
                        </div>
                    </a>
                </div>

                <div class="ms-auto sm-links">
                    <!-- <a href="#" id="profile" class="fs-20 px-md-1"><i class="fa-solid fa-user"></i></a> -->
                    <div id="wishlist">
                        <a href="{{route('wishlistpage')}}" id="wishlist" class="fs-20 px-md-1"><i class="bi bi-heart-fill"></i></a>
                        <span>0</span>
                    </div>
                    <div id="card">
                        <a href="{{route('cartpage')}}" id="card" class="fs-20 px-md-1"><i class="bi bi-bag-fill"></i></a>
                        <span>0</span>
                    </div>
                </div>

                <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <div class="collapse navbar-collapse" id="navbar">
                    <div class="navbar-brand mx-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item px-md-2">
                                <a class="nav-link fs-18" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="nav-item px-md-2">
                                <a class="nav-link fs-18" href="{{route('productpage')}}">Products</a>
                            </li>
                            <li class="nav-item px-md-2">
                                <a class="nav-link fs-18" href="{{route('contact.page')}}">Contact us</a>
                            </li>
                            @if (Route::has('login'))
                                @auth
                                <li class="nav-item px-md-2">
                                    <a class="nav-link fs-18" href="{{route('user.profile.page')}}">Account</a>
                                </li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <li class="nav-item px-md-2">
                                        <input type="submit" id="logout" style="display:none">
                                        <label for="logout" class="nav-link fs-18" style="cursor: pointer;">Logout</label>
                                    </li>
                                </form>
                                @else
                                <li class="nav-item px-md-2">
                                    <a class="nav-link fs-18" href="{{route('login')}}">Login</i></a>
                                </li>
                                    @if (Route::has('register'))
                                    <li class="nav-item px-md-2">
                                        <a class="nav-link fs-18" href="{{route('register')}}">Register</a>
                                    </li>
                                    @endif
                                @endauth
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid d-flex">
                <form action="{{route('search')}}" method="post" class="mx-auto pb-2">
                    @csrf
                    <div class="searchbox mb-2">
                        <input type="text" name="search_key" class="px-2" id="search-int" placeholder="Search" autocomplete="off">
                        <button type="submit" id="search-btn" class="fs-20 px-2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <div class="ms-auto lg-links">
                    <div id="wishlist">
                        <a href="{{route('wishlistpage')}}" id="wishlist" class="fs-20 px-md-1"><i class="bi bi-heart-fill"></i></a>
                        <span>0</span>
                    </div>
                    <div id="card">
                        <a href="{{route('cartpage')}}" id="card" class="fs-20 px-md-1"><i class="bi bi-bag-fill"></i></a>
                        <span>0</span>
                    </div>
                </div>
        </div>
    </header>

    @yield('mainsection')

    <footer class="bg-green">
        <div class="container">
            <div class="pt-3" id="subsc-bar" align="center">
                <form action="{{route('subscribe')}}" method="post">
                    @csrf
                    <i class="fs-20">For our Newsletters, Subscribe us.</i> &nbsp;&nbsp;&nbsp;
                    <input type="text" name="email" placeholder="Enter Email" required>
                    <button type="submit" id="sub-btn"><i>Subscribe</i></button>
                </form>
            </div>
        <!-- <div class="container"> -->
            <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 mt-4">
                <div class="col d-flex flex-column align-items-center">
                    <h3>Relatives</h3>
                    <ul id="relative">
                        <li>
                            <a href="{{route('welcome')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('productpage')}}">Product</a>
                        </li>
                        <li>
                            <a href="{{route('user.profile.page')}}">Account</a>
                        </li>
                        <li>
                            <a href="{{route('contact.page')}}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{route('cartpage')}}">Cart</a>
                        </li>
                        <li>
                            <a href="{{route('wishlistpage')}}">Wishlist</a>
                        </li>
                    </ul>
                </div>

                <div class="col d-flex flex-column align-items-center">
                    <h3>Categories</h3>
                    <ul id="category">
                        <li>
                            Electronic
                        </li>
                        <li>
                            Fashion
                        </li>
                        <li>
                            Furnature
                        </li>
                        <li>
                            Kitchen
                        </li>

                    </ul>
                </div>

                <div class="col d-flex flex-column align-items-center">
                    <h3>Follow Us</h3>

                    <ul id="socials">
                        <li>
                            <a href="#">
                                <i class="bi bi-facebook fs-20"></i> facebook
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-youtube fs-20"></i> youtube
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-twitter fs-20"></i> twitter
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-instagram fs-20"></i> instagram
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="bi bi-pinterest fs-20"></i> pinterest
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col d-flex flex-column align-items-center">
                    <h3>Payments</h3>

                    <ul id="payments">
                        <li>
                            {{-- <a href="#"> --}}
                                <i class="bi bi-paypal fs-20"></i> paypal
                            {{-- </a> --}}
                        </li>
                        <li>
                            {{-- <a href="#"> --}}
                                <i class="bi bi-credit-card fs-20"></i> credit
                            {{-- </a> --}}
                        </li>
                        <li>
                            {{-- <a href="#"> --}}
                                <i class="bi bi-bank fs-20"></i> local banks
                            {{-- </a> --}}
                        </li>
                        <li>
                            {{-- <a href="#"> --}}
                                <i class="bi bi-cash fs-20"></i> cash on delivery
                            {{-- </a> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="footer" class="py-3">
            <span>&copy;copyright 2021-2022 All Right Reserved, Designed and Developed by KyawZayYa.</span>
        </div>
    </footer>

    <script src="{{asset('user/js/jquery-3.6.3.js')}}"></script>
    <script src="{{asset('user/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('user/js/lightslider.js')}}"></script>
    <script src="{{asset('user/js/truncateMe.min.js')}}"></script>
    <script src="{{asset('user/js/live_file_upload.js')}}"></script>
    <script src="{{asset('user/js/custom.js')}}"></script>
    <script src="{{asset('user/js/bootstrap-input-spinner.js')}}"></script>
    <script src="{{asset('admin/js/alert.js')}}"></script>
    @yield('Javascripts')
</body>
</html>
