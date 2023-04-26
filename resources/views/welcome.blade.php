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
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                            </ul>
                        </div>
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
                                                    <span class="sale">-30%</span>

                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">Category</p>
                                                <h3 class="product-name"><a href="#" ></a>{{$product->p_name}}</h3>
                                                <h4 class="product-price">${{$product->price}}</h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="product-btns">
                                                    
                                                    <button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$product->id}}"id="wishid" name="product_id" onClick="tempwish(this)"><i class="fa fa-heart-o"></i>
                                                        
                                                        
                                                    
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
                        <div id="slick-nav-1" class="products-slick-nav"></div>
                    </div>
                </div>
            </div>
        </div>
                <!-- Products tab & slick -->
        </div>
        
       
        <!-- NEWSLETTER -->
        

@endsection
<script type="text/javascript">
 function tempwish(e) {
        console.log('tempwish line1')
         
        let ahref = $(e).attr('data-attr');
        console.log(ahref)
        let url = "{{ route('addwishlist', ['id' => ":ahref"]) }}";
        url = url.replace(":ahref", ahref);
        // let smessage = $(e).attr('#message');
        $.ajax({
            url: url,
            type: "POST",
            dataType : "json",
            data: ahref,

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
              
            
            success: function(data) {
                console.log(data.message)
                if (data.status == true) {
                    $("#message").html('<div class="alert alert-success alert-dismissible" id="message"><strong>Your product has been added to your Wishlist</strong></div>');
                } else {

                    $("#message").html('<div class="alert alert-success alert-dismissible" id="message"><strong>Your product is already in Wishlist</strong></div>');
                }
                console.log(data.message)
            }
        });
    
    }
</script>