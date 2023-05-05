@extends('applayout.mainlayout')
@section('content')
<div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h4 class="title">My Cart</h4>
                            <div class="section-nav">
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                            @foreach($products as $product)
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="products-widget-slick" data-nav="#slick-nav-3">
                                
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product">
                                    <div class="product-img">
                                        <img src="{{asset('/storage/product/'.$product->image)}}" alt="" style="width:120px;height: 150px  ;">
                                    </div>
                                </div>
                                    <div class="product-body" style="margin-left:50px;">
                                        <div class="product">
                                            <br>
                                            <h3 class="product-name"><a href="#">{{$product->p_name}} </a></h3>
                                            <h4 class="product-price">Price:&nbsp;&nbsp;${{$product->price}} 
                                                <div class="product-label">
                                                        <span class="sale"> 
                                                        <span>Discount:&nbsp;&nbsp;{{$product->discount}}%off</span>
                                                </div><br>
                                                
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
        </div>
@endsection