@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User Management</h1>
          </div>
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
              <div class="card-header">
                <div class="float-sm-right">
                <a href="{{route('user.create')}}" class="btn btn-success">Add User</a>
              </div>
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
                    <th>Status</th>
                    <th>Email</th>
                    <th>Action</th>
                    
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
                    <td>{{$user->status}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <div class='btn-group'>
                    	<a href="{{ route('user.edit',$user->id) }}" class="text-dark mt-1"><i class="fas fa-edit"></i></a>

                     <form method="post" action="{{route('user.destroy',$user->id)}}">
                            @csrf
                            <button type="submit" onclick="return myFunction();" class="btn btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  	@endforeach
                  </tbody>
                </table>
                <div class="float-sm-right mt-3 mr-2"> 
                {!! $users->links() !!}
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