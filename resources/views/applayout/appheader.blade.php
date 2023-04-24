<!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="mailto:someone@example.com"><i class="fa fa-envelope-o"></i> email@email.com</a></li>

                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                @if (Route::has('login'))
                @auth
                <ul class="header-links pull-right">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-dark" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><li><i class="fa fa-user-o"></i>My Account</li></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="background-color: #151414;"> 
                        <li><a  href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <li><a href="{{route('viewprofile')}}"><i class="fa fa-user-o"></i> My Profile</a></li>
                        <li><a href="{{route('change-password')}}"><i class="fa fa-user-o"></i> Change Password</a></li>
                </ul>
                @else
                <ul class="header-links pull-right">
                    <li><a href="{{route('login')}}"><i class="fa fa-user-o"></i> Login</a></li>
                    <li><a href="{{route('register')}}"><i class="fa fa-user-o"></i> Register</a></li>
                </ul>
                @endauth
                @endif
                </div>
                    </div>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-1">
                        <div class="header-logo">
                            <a href="{{route('home')}}" class="logo">
                                <img src="{{asset('img/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                        <div class="col-md-3">
                           <div class="header-search">
                                <form method="GET" action="{{route('getcategory')}}" >
                                    <select class="input-select" onchange="location =    this.options[this.selectedIndex].value;">
                                        <option value="{{route('home')}}">All Categories</option>
                                        @foreach(category() as $cat)
                                        <option value="{{route('getcategory')}}?category={{$cat->id}}" name="category_option"><button  class="input" name="category_option" value="{{$cat->id}}">{{$cat->category_name}}</button></a></option>
                                        @endforeach
                                    </select>
                                </form>
                                </div>
                        </div>
                            <div class="col-md-4">
                            <div class="header-search">
                                <form role="search" method="GET" action="{{route('getproduct')}}" >
                                    <input class="input" type="search" placeholder="Search" name = "search"aria-label="Search" value="{{old('search')}}">
                                    <button class="search-btn" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    
                    
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div> 
                                <a href="{{route('myfavourite')}}">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a href="{{route('setorder')}}"class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{asset('img/product01.png')}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{asset('img/product02.png')}}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) s  ted</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="{{route('setorder')}}">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <form method="GET" action="{{route('getcategory')}}" >
                  
                <ul class="main-nav nav navbar-nav">
                    
                        <li class="active"><a href="{{route('home')}}">Home</a></li>
                        {{--<li><a href="#">Hot Deals</a></li>--}}
                        @foreach(category() as $cat)
                        @if($cat->is_header == 0)
                        <li>
                        <a href="{{route('getcategory')}}?category={{$cat->id}}"name="category">{{$cat->category_name}}</a>
                            
                        </li>
                        @endif
                        @endforeach
                       
                                
                                
                </ul>
                </form>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
