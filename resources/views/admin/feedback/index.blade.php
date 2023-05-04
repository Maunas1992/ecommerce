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
                <!-- <div class="float-sm-right">
                  <a href="{{route('product.create')}}" class="btn btn-success">Add Product</a>
                </div> -->
                <!-- <h3>Products Management</h3> -->
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
                    <th>User</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($feedbacks as $key => $feedback)
                      <tr>
                        <td>{{$feedbacks->firstItem()+$key}}</td>
                        <td>{{$feedback->user->username ?? '-'}}</td>
                        <td>{{$feedback->email ?? '-'}}</td>
                        <td>{{$feedback->mobile_no ?? '-'}}</td>
                        <td>{{$feedback->subject ?? '-'}}</td>
                        <td>{{$feedback->message ?? '-'}}</td>
                        <td>
                          <div class="btn-group">
                            <span data-toggle="tooltip" data-placement="top" title="show" style="margin-top: 3px;">
                              <a class="text-dark mt-2" href="{{ route('showFeedback',$feedback->id) }}"><i class="fas fa-eye"></i></a>
                            </span>
                        
                            <form method="post" action="{{route('feedback.destroy',$feedback->id)}}">
                              @csrf
                              <span data-toggle="tooltip" data-placement="top" title="delete">
                                <button type="submit" onclick="return myFunction();" class="btn btn-sm"><i class="fas fa-trash"></i>
                                </button>
                            </span>
                            </form>
                          </div>
                        </td>
                      </tr>
                  	@endforeach
                  </tbody>
                </table>
                <div class="float-sm-right mt-3 mr-2"> 
                  {!! $feedbacks->links() !!}
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