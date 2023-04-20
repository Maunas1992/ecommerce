@extends('layouts.auth')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary"><h3 class="text-center text-light">{{ __('Change Password') }}</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-password') }}">
                        @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Old Password</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password',$user->old_password) }}" autocomplete="old_password" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('') is-invalid @enderror" name="new_password" value="{{ old('new_password',$user->new_password) }}" autocomplete="new_password">

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="confirmNewPasswordInput" type="password" class="form-control @error('dob') is-invalid @enderror" name="new_password_confirmation" >

                              
                            </div>
                        </div>


                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4"style="width:150px">
                                <button type="submit" class="btn btn-primary btn-md">
                                    Submit
                                </button>
                                <a href="{{route('home')}}"><button type="button" class="btn btn-primary btn-md">
                                    Cancel
                                </button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
