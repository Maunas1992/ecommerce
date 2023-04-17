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
                <h3>User Management</h3>
                <!-- <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div> -->
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                  	<th>No</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>DOB</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->dob}}</td>
                    <td>{{$user->city}}</td>
                    <td>{{$user->state}}</td>
                    <td>{{$user->pincode}}</td>
                    <td>{{$user->mobile_no}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    	<a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}"><i class="fas fa-edit"></i></a>
                    </td>

                    <td>
						<!-- <a class="btn btn-danger" href="{{ route('user.destroy',$user->id) }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-trash"></i>
	          			</a>
	          			<form id="logout-form" action="{{ route('user.destroy',$user->id) }}" method="POST" class="d-none">
			            @csrf
			          	</form> -->
			          	<form method="post" action="{{route('user.destroy',$user->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
					</td>
                  </tr>
                  	@endforeach
                  </tbody>
                </table>
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