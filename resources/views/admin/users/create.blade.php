@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
              <div class="card-header">
                <h3>Create User</h3>
              </div>
              <div class="card-body">
                <form action="{{route('user.store')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <input type="text" name="username" class="form-control" placeholder="Enter Username">
                      <span class="error text-danger">{{$errors->first('username')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <textarea name="address" class="form-control" placeholder="Enter Address"></textarea>
                    <span class="error text-danger">{{$errors->first('address')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth">
                    <span class="error text-danger">{{$errors->first('dob')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="radio" name="gender" value="male"> Male
                      <input type="radio" name="gender" value="female"> Female <br>
                    <span class="error text-danger">{{$errors->first('gender')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="text" name="city" class="form-control" placeholder="Enter City">
                    <span class="error text-danger">{{$errors->first('city')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="text" name="state" class="form-control" placeholder="Enter State">
                    <span class="error text-danger">{{$errors->first('state')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="text" name="country" class="form-control" placeholder="Enter Country">
                    <span class="error text-danger">{{$errors->first('country')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="text" name="pincode" class="form-control" placeholder="Enter Pincode">
                    <span class="error text-danger">{{$errors->first('pincode')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="text" name="mobile_no" class="form-control" placeholder="Enter Mobile No">
                    <span class="error text-danger">{{$errors->first('mobile_no')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    <span class="error text-danger">{{$errors->first('email')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    <span class="error text-danger">{{$errors->first('password')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
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