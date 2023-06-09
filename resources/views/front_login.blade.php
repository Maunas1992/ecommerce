@extends('applayout.mainlayout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<div class="newsletter"><br>
                <p style="margin-left: 80px;"><strong>Login Page</strong></p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                	<div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email:</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email" autofocus>
                            @error('email')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
                            @enderror
                        </div>
                    </div><br>
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password:</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                	<strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div><br>

                    <!-- <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div> -->
                    <div class="add-to-cart" style="margin-left: 80px;">
                        <button class="btn btn-success" type="submit">Login</button>
                    </div>
                </form>
                <ul class="newsletter-follow" style="margin-left: 80px;">
                    <li>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </li>
                </ul> <br>
            </div>
        </div>
    </div>
                <!-- /row -->
</div>
@endsection