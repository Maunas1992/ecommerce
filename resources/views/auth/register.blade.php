@extends('applayout.mainlayout')
@section('content')
<div class="section">
    <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-10">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title" style="margin-left: 250px">Register</h3>
                        </div>
                        <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Name:</label>
                            <input id="username" type="text" class="input @error('username') is-invalid @enderror" name="username" value="{{ old('username')}}" placeholder="Enter Name" autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Address:</label>
                            <textarea id="address" type="text" class="input @error('address') is-invalid @enderror" name="address" placeholder="Enter Address" autocomplete="address">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> DOB:</label>
                            <input id="dob" type="date" class="input @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" autocomplete="dob">
                            @error('dob')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Gender:&nbsp;</label>
                            <input  type="radio" class="@error('gender') is-invalid @enderror" name="gender" id="Male"value="male"  {{ old('gender') == 'male' ? 'checked' : '' }}>Male
                            <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" id="Female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>Female <br>
                            @error('gender')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> City:</label>
                            <input id="city" type="text" class="input @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="Enter City" autocomplete="city">
                            @error('city')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> State:</label>
                            <input id="state" type="text" class="input @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" placeholder="Enter State" autocomplete="state">
                            @error('state')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Country:</label>
                            <input id="country" type="text" class="input @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" placeholder="Enter Country" autocomplete="country">

                            @error('country')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Pincode:</label>
                            <input id="pincode" type="text" class="input @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" placeholder="Enter Pincode" autocomplete="pincode">

                            @error('pincode')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Mobile No:</label>
                            <input id="mobile_no" type="text" class="input @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Enter Mobile No" autocomplete="mobile_no">

                            @error('mobile_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Email:</label>
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Password:</label>
                            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Enter Password">

                            @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Confirm Password:</label>
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" value="{{ old('password_confirmation')}}" placeholder="Enter Confirm Password">
                        </div>
                        <div class="form-group" style="margin-left: 530px">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <!-- <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Shiping address</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Ship to a diffrent address?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input class="input" type="text" name="first-name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="last-name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="country" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="tel" name="tel" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- /Shiping Details -->

                        <!-- Order notes -->
                        <!-- <div class="order-notes">
                            <textarea class="input" placeholder="Order Notes"></textarea>
                        </div> -->
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <!-- <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                <div class="order-col">
                                    <div>1x Product Name Goes Here</div>
                                    <div>$980.00</div>
                                </div>
                                <div class="order-col">
                                    <div>2x Product Name Goes Here</div>
                                    <div>$980.00</div>
                                </div>
                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">$2940.00</strong></div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Paypal System
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div>
                        <a href="#" class="primary-btn order-submit">Place order</a>
                    </div> -->
                    <!-- /Order Details -->
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
@endsection
