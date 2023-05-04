@extends('applayout.mainlayout')
@section('content')
    <!-- SECTION -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
{{--<div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    
                    <!-- Product main img -->
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <div id="product-main-img">
                            <div class="product-preview">
                                <img src="{{asset('/storage/product/'.$product->productsfav->image)}}" alt="">
                            <h2 class="product-name">{{$product->productsfav->p_name}}</h2>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="col-md-6">
                        <div class="product-details">
                            
                            <div>
                                <h3 class="product-price"></h3>
                            </div>

                        </div>
                    </div>
                        
           
                </div>
            </div>
                                <!-- /tab3  -->
</div>--}}
                            
<div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h4 class="title">My Wishlist</h4>
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
                                        <img src="{{asset('/storage/product/'.$product->productsfav->image)}}" alt="" style="width:120px;height: 150px  ;">
                                    </div>
                                </div>
                                    <div class="product-body" style="margin-left:50px;">
                                        <div class="product">
                                            <br>
                                            <h3 class="product-name"><a href="#">{{$product->productsfav->p_name}} </a></h3>
                                            <h4 class="product-price">Price:&nbsp;&nbsp;${{$product->productsfav->price}} 
                                                <div class="product-label">
                                                        <span class="sale"> 
                                                        <span>Discount:&nbsp;&nbsp;{{$product->productsfav->discount}}%off</span>
                                                </div><br>
                                                <form method="post" action="{{route('removewishlist',$product->id)}}">
                                                    @csrf
                                                    <span data-toggle="tooltip" data-placement="top" title="delete">
                                                        <button type="submit" onclick="return myFunction();" class="add-to-wishlist"><i class="fa fa-trash"></i>
                                                        </button>
                                                    </span>
                                                </form>
                                                <button class="quick-view" style="position:relative; left:40px; bottom:35px;">
                                                    <span class="tooltipp" style="margin-top:20px;"><a href="{{route('showproduct',['id'=>$product->product_id])}}"><i class="fa fa-eye"></i></a></span>
                                                </button>
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
<script type="text/javascript">
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
  </script>