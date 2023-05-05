@extends('applayout.mainlayout')
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- BREADCRUMB -->
		
			<!-- container -->
			<div class="container">
				<!-- row -->
				
				<!-- /row -->
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
								        		<input type="checkbox" id="m{{$m}}" class="marchio"data-attr="{{ $marchio->id }}" name="category_ids[]" onClick="filterProducts(this)" value="{{ $marchio->id }}"
								        		@if (request()->get('category_ids'))
								        		{{ in_array( $marchio->id, request()->get('category_ids')) ? 'checked':'' }}
								        		@endif >
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
					</div>
					<div id="store" class="col-md-9">
					
						<div id="message"></div>
						<!-- store products -->
							<div class="row categorydetail" id="categorydetail">
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
								            	
								            	<h3 class="product-name"><a href="#"></a>{{$product->p_name}}</h3>
								            	<h4 class="product-price">${{$product->price}}</h4>
								            
								            	<div class="product-btns">
								            	@if(Route::has('login'))
                    							@auth
								                <button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$product->id}}"id="wishid" name="product_id" onClick="tempwish(this)">

								                @if(in_array($product->id,$productschecked))
								                	<i class="fa fa-heart" aria-hidden="true"></i>
								                @else
								                <i class="fa fa-heart-o"></i>
								                @endif
								            	</button>
								            	@else
                                                    <button class="add-to-wishlist"><a href="{{route('login')}}"><i class="fa fa-heart-o"></i></a>
                                                        @endauth
                                                        @endif
								         		<button class="quick-view"><a href="{{route('showproduct',['id'=>$product->id])}}">
								            	<i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
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
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
	function filterProducts(currentElement) {
		
		var formData = $('#catform').serialize();
		console.log($('#catform').serialize());
		let bhref = $(currentElement).attr('data-attr');
        console.log(bhref)
        let url = "{{ route('getcategory', ['id' => ":bhref"]) }}";
        url = url.replace(bhref);
        console.log(url)
		$.ajax({
	        url: url,
	        type: 'get',
			data: formData,
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
