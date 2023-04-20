@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('user.index')}}">User</a></li>
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

            <div class="card">
              <div class="card-body">
                <form action="{{route('user.update',$users->id)}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <label>Username: <span class="text-danger">*</span></label>
                      <input type="text" name="username" class="form-control" value="{{$users->username}}" placeholder="Enter Username">
                      <span class="error text-danger">{{$errors->first('username')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Address: <span class="text-danger">*</span></label>
                      <textarea name="address" class="form-control mb-3" placeholder="Enter Address">{{$users->address}}</textarea>
                      <span class="error text-danger">{{$errors->first('address')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Date of Birth: <span class="text-danger">*</span></label>
                      <input type="date" name="dob" value="{{$users->dob}}" class="form-control mb-3" placeholder="Enter Date of Birth">
                      <span class="error text-danger">{{$errors->first('dob')}}</span>
                    </div>

                    <div class="col-6 mt-2">
                      <label>Gender: <span class="text-danger">*</span></label><br>
                      <input type="radio" name="gender" value="male" {{ $users->gender == 'male' ? 'checked' : '' }} {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                      <input type="radio" name="gender" value="female" {{ $users->gender == 'female' ? 'checked' : '' }} {{ old('gender') == 'female' ? 'checked' : '' }}> Female <br>
                      <span class="error text-danger">{{$errors->first('gender')}}</span>
                    </div>

                    <div class="col-6">
                      <label>City: <span class="text-danger">*</span></label>
                      <input type="text" name="city" value="{{$users->city}}" class="form-control mb-3" placeholder="Enter City">
                      <span class="error text-danger">{{$errors->first('city')}}</span>
                    </div>

                    <div class="col-6">
                      <label>State: <span class="text-danger">*</span></label>
                      <input type="text" name="state" value="{{$users->state}}" class="form-control" placeholder="Enter State">
                      <span class="error text-danger">{{$errors->first('state')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Country: <span class="text-danger">*</span></label>
                      <input type="text" name="country" value="{{$users->country}}" class="form-control mb-3" placeholder="Enter Country">
                      <span class="error text-danger">{{$errors->first('country')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Pincode: <span class="text-danger">*</span></label>
                      <input type="text" name="pincode" value="{{$users->pincode}}" class="form-control" placeholder="Enter Pincode">
                      <span class="error text-danger">{{$errors->first('pincode')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Mobile No: <span class="text-danger">*</span></label>
                      <input type="text" name="mobile_no" value="{{$users->mobile_no}}" class="form-control mb-3" placeholder="Enter Mobile No">
                      <span class="error text-danger">{{$errors->first('mobile_no')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Email: <span class="text-danger">*</span></label>
                      <input type="email" name="email" value="{{$users->email}}" class="form-control" placeholder="Enter Email">
                      <span class="error text-danger">{{$errors->first('email')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Password: <span class="text-danger">*</span></label>
                      <input type="password" name="password" value="{{$users->password}}" class="form-control mb-3" placeholder="Enter Password">
                      <span class="error text-danger">{{$errors->first('password')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ $users->status == 'Active' ? 'selected' : '' }} {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $users->status == 'Inactive' ? 'selected' : '' }} {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('user.index')}}" class="btn btn-danger">Cancle</a>
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