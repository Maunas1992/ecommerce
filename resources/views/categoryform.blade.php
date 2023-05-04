@foreach($products as $product)

<div class="col-md-4 col-xs-6">
    <div class="product">
        <div class="product-img">
            <img src="{{asset('/storage/product/'.$product->image)}}" alt="">
            <div class="product-label">
                <span class="sale">{{$product->discount}}%off</span>
                
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">Category</p>
            <h3 class="product-name"><a href="#"></a>{{$product->p_name}}</h3>
            <h4 class="product-price">${{$product->price}}</h4>
            
            <div class="product-btns">
                @if(Route::has('login'))
                @auth
                <button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$product->id}}"id="wishid" name="product_id" onClick="tempwish(this)">
                    
                    @if(in_array($product->id,$productschecked))
                    <i class="fa fa-heart" aria-hidden="true"></i>@else
                    <i class="fa fa-heart-o"></i>
                    @endif
                </button>
                @else
                <button class="add-to-wishlist"><a href="{{route('login')}}"></a></button><i class="fa fa-heart-o"></i>
                @endauth
                @endif

                <button class="quick-view"><a href="{{route('showproduct',['id'=>$product->id])}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
            </div>
        </div>
        <div class="add-to-cart">
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </div>
    </div>
</div>
<!-- /product -->
@endforeach
