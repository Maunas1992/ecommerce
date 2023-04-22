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

            @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>{{$message}}</strong>
              </div>
            @endif
            <div class="card">
              <div class="card-body">
                <form action="{{route('adminUpdatePassword',$users->id)}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <label>Old Password: <span class="text-danger">*</span></label>
                      <input type="password" name="old_password" class="form-control mb-1" placeholder="Enter Old Password">
                      <span class="error text-danger">{{$errors->first('old_password')}}</span>
                    </div>

                    <div class="col-6">
                      <label>New Password: <span class="text-danger">*</span></label>
                      <input type="password" name="new_password" class="form-control mb-1" placeholder="Enter New Password">
                      <span class="error text-danger">{{$errors->first('new_password')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Confirm New Password:</label>
                      <input type="password" name="new_password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Change Password</button>
                  <a href="{{route('home')}}" class="btn btn-danger">Cancle</a>
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