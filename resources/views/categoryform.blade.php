
@foreach($products as $product)
<div class="col-md-4 col-xs-6">
    <div class="product">
        <div class="product-img">
            <img src="{{asset('/storage/product/'.$product->image)}}" alt="">
            <div class="product-label">
                <span class="sale">-30%</span>
                <span class="new">NEW</span>
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">Category</p>
            <h3 class="product-name"><a href="#"></a>{{$product->p_name}}</h3>
            <h4 class="product-price">{{$product->price}}</h4>
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="product-btns">
                <button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$product->id}}"id="wishid" name="product_id" onClick="tempwish(this)">
                    <i class="fa fa-heart-o"></i>
                    @auth
                    @if(in_array($product->id,$productschecked))
                    <i class="fa fa-heart" aria-hidden="true"></i>@else
                    <i class="fa fa-heart-o"></i>
                    @endif
                    @endauth

                </button>
                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
            </div>
        </div>
        <div class="add-to-cart">
            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
        </div>
    </div>
</div>
<!-- /product -->
@endforeach
