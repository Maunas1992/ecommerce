@extends('applayout.mainlayout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                       
                    </div>
                </div>

                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div id="message"></div>
                        
                    <div class="row">
                        
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @foreach($products as $product)
                                    <div class="col-md-4 col-xs-4">
                                        <div class="product">
                                            <div class="product-img">
                                                @if($product->image)
                                                <img src="{{asset('/storage/product/'.$product->image)}}" alt="" >
                                                @else
                                                No Image
                                                @endif
                                                <div class="product-label">
                                                    <span class="sale">{{$product->discount}}%off</span>

                                                    
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                
                                                <h3 class="product-name"><a href="#" ></a>{{$product->p_name}}</h3>
                                                <h4 class="product-price">${{$product->price}}</h4>
                                                
                                                <div class="product-btns">
                                                    @if (Route::has('login'))
                                                    @auth
                                                    <button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$product->id}}"id="wishid" name="product_id" onClick="tempwish(this)">
                                                    
                                                    @if(in_array($product->id,$productschecked))
                                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-heart-o"></i>
                                                    @endif
                                                    @else
                                                    <button class="add-to-wishlist"><a href="{{route('login')}}"><i class="fa fa-heart-o"></i></a>
                                                        @endauth
                                                        @endif
                                                    <button class="quick-view"><a href="{{route('showproduct',['id'=>$product->id])}}"><i class="fa fa-eye"></i></a><span class="tooltipp">quick view</span></button>
                                                </div>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="products-slick-nav">
                                
                                <div id="slick-nav-1" class="products-slick-nav-danger"></div>
                            </div>
                                    <!-- /product -->
                        </div>
                        <br><b>
                        
                        
                    </div>
                </div>
            </div>
            <div id="slick-nav-1" class="products-slick-nav-pull-5">{!! $products->withQueryString()->links() !!}</div>
        </div>
               
                <!-- Products tab & slick -->
        </div>
        
       
        <!-- NEWSLETTER -->
        

@endsection
