@foreach($products as $product)
                                    <div class="col-md-4 col-xs-4">
                                        <div class="product" >
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
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach