@extends('applayout.mainlayout')
@section('content')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						
						<ul class="breadcrumb-tree">
							<li><a href="{{url('/')}}">Home</a></li>
							<li><a href="{{url('/')}}">All Categories</a></li>
							
							<li class="active">{{$products->p_name}}</li>
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{asset('/storage/product/'.$products->image)}}" alt="">
							</div>

							
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							

							
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{ $products->p_name}}</h2>
							<div>
								
								
							</div>
							<div>
								<h3 class="product-price">Price:${{$products->price}}
								</h3>
								&nbsp;<span class="product-available">Discount:{{$products->discount}}%</span>
								
								<span class="product-available">IN STOCK:&nbsp;&nbsp;{{$products->qty}}</span>
							</div>
							<p>{{$products->description}}</p>

							<div class="product-options">
								<label>
									Color
									<select class="input-select">
										<option value="0"> Color</option>
										@foreach($productVariant as $variant )
										<option value="{{$variant->color}}">{{$variant->color}}</option>
										@endforeach
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
								&nbsp;
								@if (Route::has('login'))
                                                    @auth
								<div class="product-btns">
								<button class="add-to-wishlist" data-target="#appendiv" data-attr="{{$products->id}}"id="wishid" name="product_id" onClick="tempwish(this)">
								@if(in_array($products->id,$productschecked))
								    <i class="fa fa-heart" aria-hidden="true"></i>
								@else
				                	<i class="fa fa-heart-o"></i>
				                @endif
				            	</button>
				            	@else
				            	@endauth
				            	@endif

				            </div>
								
							</div>
						
						
						<div class="col-md-12">
							<div id="product-tab">
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>

				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		
		<!-- /NEWSLETTER -->

@endsection
