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
                <form action="{{route('user.update',$users->id)}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <input type="text" name="username" class="form-control" value="{{$users->username}}" placeholder="Enter Username">
                    </div>

                    <div class="col-6">
                      <textarea name="address" class="form-control mb-3" placeholder="Enter Address">{{$users->address}}</textarea>
                    </div>

                    <div class="col-6">
                      <input type="date" name="dob" value="{{$users->dob}}" class="form-control mb-3" placeholder="Enter Date of Birth">
                    </div>

                    <div class="col-6">
                      <input type="radio" name="gender" value="male" {{ $users->gender == 'male' ? 'checked' : '' }}> Male
                      <input type="radio" name="gender" value="female" {{ $users->gender == 'female' ? 'checked' : '' }}> Female
                    </div>

                    <div class="col-6">
                      <input type="text" name="city" value="{{$users->city}}" class="form-control mb-3" placeholder="Enter City">
                    </div>

                    <div class="col-6">
                      <input type="text" name="state" value="{{$users->state}}" class="form-control" placeholder="Enter State">
                    </div>

                    <div class="col-6">
                      <input type="text" name="country" value="{{$users->country}}" class="form-control mb-3" placeholder="Enter Country">
                    </div>

                    <div class="col-6">
                      <input type="text" name="pincode" value="{{$users->pincode}}" class="form-control" placeholder="Enter Pincode">
                    </div>

                    <div class="col-6">
                      <input type="text" name="mobile_no" value="{{$users->mobile_no}}" class="form-control mb-3" placeholder="Enter Mobile No">
                    </div>

                    <div class="col-6">
                      <input type="email" name="email" value="{{$users->email}}" class="form-control" placeholder="Enter Email">
                    </div>

                    <div class="col-6">
                      <input type="password" name="password" value="{{$users->password}}" class="form-control mb-3" placeholder="Enter Password">
                    </div>

                    <div class="col-6">
                      <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
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