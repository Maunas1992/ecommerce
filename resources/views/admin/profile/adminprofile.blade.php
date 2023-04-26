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
                      <input type="radio" name="gender" value="male" {{ old('gender') ? old('gender') :  $users->gender == 'male' ? 'checked' : '' }} {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                      <input type="radio" name="gender" value="female" {{ old('gender') ? old('gender') :  $users->gender == 'female' ? 'checked' : '' }} {{ old('gender') == 'female' ? 'checked' : '' }}> Female <br>
                      <span class="error text-danger">{{$errors->first('gender')}}</span>
                    </div>

                    <div class="col-6">
                      <label>City: <span class="text-danger">*</span></label>
                      <input type="text" name="city" value="{{ old('city') ? old('city') : $users->city}}" class="form-control mb-3" placeholder="Enter City">
                      <span class="error text-danger">{{$errors->first('city')}}</span>
                    </div>

                    <div class="col-6">
                      <label>State: <span class="text-danger">*</span></label>
                      <input type="text" name="state" value="{{ old('state') ? old('state') : $users->state}}" class="form-control" placeholder="Enter State">
                      <span class="error text-danger">{{$errors->first('state')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Country: <span class="text-danger">*</span></label>
                      <input type="text" name="country" value="{{ old('country') ? old('country') : $users->country}}" class="form-control mb-3" placeholder="Enter Country">
                      <span class="error text-danger">{{$errors->first('country')}}</span>
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
                        <option value="Active" {{ old('status') ? old('status') :  $users->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') ? old('status') :  $users->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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