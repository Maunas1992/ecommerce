@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Profile Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('adminprofile')}}">Profile</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <!-- /.card -->
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>{{$message}}</strong>
              </div>
            @endif
            <div class="card">
              <div class="card-body">
                <form action="{{route('adminUpdateProfile',$users->id)}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <label>Name: <span class="text-danger">*</span></label>
                      <input type="text" name="username" class="form-control" value="{{ old('username') ? old('username') : $users->username}}" placeholder="Enter Name">
                      <span class="error text-danger">{{$errors->first('username')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Address: <span class="text-danger">*</span></label>
                      <textarea name="address" class="form-control mb-3" placeholder="Enter Address">{{ old('address') ? old('address') : $users->address}}</textarea>
                      <span class="error text-danger">{{$errors->first('address')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Date of Birth: <span class="text-danger">*</span></label>
                      <input type="date" name="dob" value="{{ old('dob') ? old('dob') : $users->dob}}" class="form-control mb-3" placeholder="Enter Date of Birth">
                      <span class="error text-danger">{{$errors->first('dob')}}</span>
                    </div>

                    <div class="col-6 mt-2">
                      <label>Gender: <span class="text-danger">*</span></label><br>
                      <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} {{ $users->gender == 'male' ? 'checked' : ''  }}> Male
                      <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} {{ $users->gender == 'female' ? 'checked' : ''  }}> Female <br>
                      <span class="error text-danger">{{$errors->first('gender')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Country: <span class="text-danger">*</span></label>
                      <!--<input type="text" name="country" value="{{ old('country') ? old('country') : $users->country}}" class="form-control mb-3" placeholder="Enter Country"> -->
                      <select name="country_id" id="country_id" class="form-control">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected' : '' }} {{ $users->country_id == $country->id ? 'selected' : ''  }}>
                          {{$country->country_name}}
                        </option>
                        @endforeach
                      </select>
                      <input type="hidden" class="country" value="{{$users->country_id}}">
                      <span class="error text-danger">{{$errors->first('country_id')}}</span>
                    </div>

                    <div class="col-6">
                      <label>State: <span class="text-danger">*</span></label>
                      <!--<input type="text" name="state" value="{{ old('state') ? old('state') : $users->state}}" class="form-control" placeholder="Enter State"> -->
                      <select name="state_id" id="state_id" class="form-control">
                      </select>
                      <input type="hidden" class="state" value="{{$users->state_id}}">
                      <span class="error text-danger">{{$errors->first('state_id')}}</span>
                    </div>

                    <div class="col-6">
                      <label>City: <span class="text-danger">*</span></label>
                      <!-- <input type="text" name="city" value="{{ old('city') ? old('city') : $users->city}}" class="form-control mb-3" placeholder="Enter City"> -->
                      <select name="city_id" id="city_id" class="form-control">
                      </select>
                      <input type="hidden" class="city" value="{{$users->city_id}}">
                      <span class="error text-danger">{{$errors->first('city_id')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Pincode: <span class="text-danger">*</span></label>
                      <input type="text" name="pincode" value="{{ old('pincode') ? old('pincode') : $users->pincode}}" class="form-control" placeholder="Enter Pincode">
                      <span class="error text-danger">{{$errors->first('pincode')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Mobile No: <span class="text-danger">*</span></label>
                      <input type="text" name="mobile_no" value="{{ old('mobile_no') ? old('mobile_no') : $users->mobile_no}}" class="form-control mb-3" placeholder="Enter Mobile No">
                      <span class="error text-danger">{{$errors->first('mobile_no')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Email: <span class="text-danger">*</span></label>
                      <input type="email" name="email" value="{{ old('email') ? old('email') : $users->email}}" class="form-control" placeholder="Enter Email">
                      <span class="error text-danger">{{$errors->first('email')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }} {{ $users->status == 'Active' ? 'selected' : ''  }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }} {{ $users->status == 'Inactive' ? 'selected' : ''  }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('home')}}" class="btn btn-danger">Cancel</a>
                </form>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
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