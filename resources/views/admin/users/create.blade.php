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
                <form action="{{route('user.store')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <label>Name: <span class="text-danger">*</span></label>
                      <input type="text" name="username" value="{{old('username')}}" class="form-control" placeholder="Enter Name">
                      <span class="error text-danger">{{$errors->first('username')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Address: <span class="text-danger">*</span></label>
                      <textarea name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address"></textarea>
                    <span class="error text-danger">{{$errors->first('address')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Mobile No: <span class="text-danger">*</span></label>
                      <input type="text" name="mobile_no" value="{{old('mobile_no')}}" class="form-control" placeholder="Enter Mobile No">
                    <span class="error text-danger">{{$errors->first('mobile_no')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Email: <span class="text-danger">*</span></label>
                      <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                    <span class="error text-danger">{{$errors->first('email')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Password: <span class="text-danger">*</span></label>
                      <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="error text-danger">{{$errors->first('password')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Confirm Password:</label>
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                    </div>

                    <div class="col-6">
                      <label>Date of Birth: <span class="text-danger">*</span></label>
                      <input type="date" name="dob" value="{{old('dob')}}" class="form-control" placeholder="Enter Date of Birth">
                    <span class="error text-danger">{{$errors->first('dob')}}</span>
                    </div>

                    <div class="col-6 mt-2">
                      <label>Gender: <span class="text-danger">*</span></label><br>
                      <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Male
                      <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Female <br>
                    <span class="error text-danger">{{$errors->first('gender')}}</span>
                    </div>

                    <div class="col-6">
                      <label>City: <span class="text-danger">*</span></label>
                      <input type="text" name="city" value="{{old('city')}}" class="form-control" placeholder="Enter City">
                    <span class="error text-danger">{{$errors->first('city')}}</span>
                    </div>

                    <div class="col-6">
                      <label>State: <span class="text-danger">*</span></label>
                      <input type="text" name="state" value="{{old('state')}}" class="form-control" placeholder="Enter State">
                    <span class="error text-danger">{{$errors->first('state')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Country: <span class="text-danger">*</span></label>
                      <input type="text" name="country" value="{{old('country')}}" class="form-control" placeholder="Enter Country">
                    <span class="error text-danger">{{$errors->first('country')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Pincode: <span class="text-danger">*</span></label>
                      <input type="text" name="pincode" value="{{old('pincode')}}" class="form-control" placeholder="Enter Pincode">
                    <span class="error text-danger">{{$errors->first('pincode')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
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