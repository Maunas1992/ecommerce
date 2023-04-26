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
              <li class="breadcrumb-item active"><a href="{{route('product.index')}}">User</a></li>
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
                <div class="float-sm-right">
                <a href="{{route('user.index')}}" class="btn btn-success">Back</a>
              </div>
              </div>
              <div class="card-body table-responsive p-0">
                <div class="col-6">
                  <label>No</label>
                  <p>{{$users->id}}</p>
                </div>

                <div class="col-6">
                  <label>Name</label>
                  <p>{{$users->username}}</p>
                </div>

                <div class="col-6">
                  <label>Address</label>
                  <p>{{$users->address}}</p>
                </div>

                <div class="col-6">
                  <label>Date Of Birth</label>
                  <p>{{$users->dob}}</p>
                </div>

                <div class="col-6">
                  <label>Gender</label>
                  <p>{{$users->gender}}</p>
                </div>

                <div class="col-6">
                  <label>Pincode</label>
                  <p>{{$users->pincode}}</p>
                </div>

                <div class="col-6">
                  <label>City</label>
                  <p>{{$users->city}}</p>
                </div>

                <div class="col-6">
                  <label>State</label>
                  <p>{{$users->state}}</p>
                </div>

                <div class="col-6">
                  <label>Mobile No</label>
                  <p>{{$users->mobile_no}}</p>
                </div>

                <div class="col-6">
                  <label>Email</label>
                  <p>{{$users->email}}</p>
                </div>

                <div class="col-6">
                  <label>Status</label>
                  <p>{{$users->status}}</p>
                </div>
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

  <script type="text/javascript">
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
  </script>
@endsection