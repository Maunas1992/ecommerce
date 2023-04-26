@extends('applayout.mainlayout')
@section('content')
	

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li><a href="#">All Categories</a></li>
							<li><a href="#">Accessories</a></li>
							<li class="active">Headphones (227,490 Results)</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<form method="GET" name="catform" id="catform" action="{{ route('getcategory')}}">
								@csrf

							<div class="checkbox-filter">
								<ul class="check-box-list">
      								<?php $m = 1; ?>
								        @foreach($categories as $marchio)
								        
								        	<li>
								        		<input type="checkbox" id="m{{$m}}" class="marchio" name="category_ids[]" value="{{ $marchio->id }} 
								        		{{ (collect(old('category_ids',$oldcatid))->contains($marchio->id)) ? 'checked':'' }}" onClick="filterProducts(this)" >
								        	
								          		<label for="m{{$m}}">
								            	<span class="button"></span>
								            	@if(isset($marchio->id))
								               	{{ $marchio->category_name }}
								               	@endif
								            	</label>   
								     		</li>
								 			<?php $m++; ?>
								 			
								     	@endforeach   
								</ul>
							</div>
						</form>
					</div>
						<!-- aside Widget -->
						
						<!-- /aside Widget -->

						<!-- aside Widget -->
					
						<!-- /aside Widget -->

						<!-- aside Widget -->
						
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row categorydetail" id="categorydetail">
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
								                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
								                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
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
						</div>
						<!-- /store products -->

						
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		{!! $products->withQueryString()->links() !!}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
	function filterProducts(currentElement) {
		console.log('filterProducts line1')
		var formData = $('#catform').serialize();
		console.log($('#catform').serialize());
		$.ajax({
	        url: "{{route('getcategory')}}",
	        type: 'get',
			data: formData,
			success: function(data) {
				if (data.status) {
                	$("#categorydetail").html(data.html);
				} else {
					$("#categorydetail").html('No products available.')
				}
            }
                  
   		});
	}
                    
</script>
