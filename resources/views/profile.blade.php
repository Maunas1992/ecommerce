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
                        @if ($message = Session::get('success'))
                          <div class="alert alert-success alert-dismissible">
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert"></button> -->
                            <strong>{{$message}}</strong>
                          </div>
                        @endif
                        <div class="section-title">
                            <h3 class="title" style="margin-left: 250px">Update Profile</h3>
                        </div>
                        <form action="{{ route('updateprofile',$user->id) }}" method="post">
                        @csrf
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Name:</label>
                            <input id="username" type="text" class="input @error('username') is-invalid @enderror" name="username" value="{{ old('username',$user->username) }}" placeholder="Enter Name" autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Address:</label>
                            <textarea id="address" type="text" class="input @error('address') is-invalid @enderror" name="address" placeholder="Enter Address" autocomplete="address">{{ old('address',$user->address) }}</textarea>
                            @error('address')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> DOB:</label>
                            <input id="dob" type="date" class="input @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob',$user->dob) }}" autocomplete="dob">
                            @error('dob')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Gender:&nbsp;</label>
                            <input  type="radio" class="@error('gender') is-invalid @enderror" name="gender" id="Male" value="male"  {{ old('gender') == 'male' ? 'checked' : '' }} {{ $user->gender == 'male' ? 'checked' : ''  }}>Male
                            <input type="radio" class="@error('gender') is-invalid @enderror" name="gender" id="Female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} {{ $user->gender == 'female' ? 'checked' : ''  }}>Female <br>
                            @error('gender')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Country:</label>
                            <!--<input id="country" type="text" class="input @error('country') is-invalid @enderror" name="country" value="{{ old('country',$user->country) }}" placeholder="Enter Country" autocomplete="country"> -->
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected' : '' }} {{ $user->country_id == $country->id ? 'selected' : ''  }}>
                                  {{$country->country_name}}
                                </option>
                                @endforeach
                            </select>
                            <input type="hidden" class="country" value="{{$user->country_id}}">

                            @error('country_id')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> State:</label>
                            <!-- <input id="state" type="text" class="input @error('state') is-invalid @enderror" name="state" value="{{ old('state',$user->state) }}" placeholder="Enter State" autocomplete="state"> --> 
                            <select name="state_id" id="state_id" class="form-control">
                            </select>
                            <input type="hidden" class="state" value="{{$user->state_id}}">
                            @error('state_id')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> City:</label>
                            <!-- <input id="city" type="text" class="input @error('city') is-invalid @enderror" name="city" value="{{ old('city',$user->city) }}" placeholder="Enter City" autocomplete="city"> -->
                            <select name="city_id" id="city_id" class="form-control">
                            </select>
                            <input type="hidden" class="city" value="{{$user->city_id}}">
                            @error('city_id')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Pincode:</label>
                            <input id="pincode" type="text" class="input @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode',$user->pincode) }}" placeholder="Enter Pincode" autocomplete="pincode">

                            @error('pincode')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Mobile No:</label>
                            <input id="mobile_no" type="text" class="input @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no',$user->mobile_no) }}" placeholder="Enter Mobile No" autocomplete="mobile_no">

                            @error('mobile_no')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Email:</label>
                            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" placeholder="Enter Email" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Password:</label>
                            <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" value="{{old('password',$user->password)}}" placeholder="Enter Password">

                            @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style="margin-left: 250px">
                            <label for="name"> Confirm Password:</label>
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="Enter Confirm Password">
                        </div> -->
                        <div class="form-group" style="margin-left: 530px">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      var dbcountryval = $('.country').val(); 
      var dbstateval = $('.state').val();   
      var dbcityval = $('.city').val();   
        var oldcountry_var = '{{ old('country_id') }}';
        var oldstate_var = '{{ old('state_id') }}';
        var oldcity_var = '{{ old('city_id') }}';
        if (oldcountry_var) {
            $('#country_id option[value="'+oldcountry_var+'"]').attr('selected', 'selected');
            getState(oldcountry_var)
            setTimeout(function() {
                $('#state_id option[value="'+oldstate_var+'"]').attr('selected', 'selected');
            }, 500);
            getCity(oldstate_var)
        }else if(dbcountryval){
          $('#country_id option[value="'+dbcountryval+'"]').attr('selected', 'selected');
            getState(dbcountryval)
            setTimeout(function() {
                $('#state_id option[value="'+dbstateval+'"]').attr('selected', 'selected');
            }, 500);
            getCity(dbstateval)
        }
        if (oldstate_var) {
            $('#state_id option[value="'+oldstate_var+'"]').attr('selected', 'selected');
            setTimeout(function() {
                $('#city_id option[value="'+oldcity_var+'"]').attr('selected', 'selected');
             }, 500);
            getCity(oldstate_var)
        }else if(dbstateval){
          $('#state_id option[value="'+dbstateval+'"]').attr('selected', 'selected');
            setTimeout(function() {
                $('#city_id option[value="'+dbcityval+'"]').attr('selected', 'selected');
             }, 500);
            getCity(dbstateval)
        }
        $('#country_id').on('change', function() {
            var country_id = this.value; 
            $("#state_id").html('');
            getState(country_id)
        });
        $('#state_id').on('change', function() {
            var state_id = this.value;
            $("#city_id").html('');
            getCity(state_id)
        });
        });
        function getState(country_id) {
            $.ajax({
                url:"{{route('getState')}}",
                type: "POST",
                data: {
                country_id: country_id,
                _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#state_id').html('<option value="">Select State</option>'); 
                    $.each(result.states,function(key,value){
                    $("#state_id").append('<option value="'+value.id+'">'+value.state_name+'</option>');
                    });
                    $('#city_id').html('<option value="" >Select State First</option>'); 
                }
            });
        }
        function getCity(state_id) { 
            $.ajax({
                url:"{{route('getCity')}}",
                type: "POST",
                data: {
                state_id: state_id,
                _token: '{{csrf_token()}}' 
                },
                dataType : 'json',
                success: function(result){
                    $('#city_id').html('<option value="">Select City</option>'); 
                    $.each(result.cities,function(key,value){
                    $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
        }
</script>