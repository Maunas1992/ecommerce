@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Feedback Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Feedback</a></li>
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
              <div class="card-header">
                <div class="float-sm-right">
                <a href="{{route('feedbackList')}}" class="btn btn-success">Back</a>
              </div>
              </div>
              <div class="card-body table-responsive p-0">
                <div class="col-6">
                  <label>No</label>
                  <p>{{$feedbacks->id}}</p>
                </div>

                <div class="col-6">
                  <label>User</label>
                  <p>{{$feedbacks->user->username}}</p>
                </div>

                <!-- <div class="col-6">
                  <label>Name</label>
                  <p>{{$feedbacks->name}}</p>
                </div> -->

                <div class="col-6">
                  <label>Email</label>
                  <p>{{$feedbacks->email}}</p>
                </div>

                <div class="col-6">
                  <label>Mobile No</label>
                  <p>{{$feedbacks->mobile_no}}</p>
                </div>

                <div class="col-6">
                  <label>Subject</label>
                  <p>{{$feedbacks->subject}}</p>
                </div>

                <div class="col-6">
                  <label>Message</label>
                  <p>{{$feedbacks->message}}</p>
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