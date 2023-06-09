@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Category</a></li>
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
                  <a href="{{route('category.create')}}" class="btn btn-success">Add Category</a>
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
                    <th>Name</th>
                    <th>Is Header</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($categories as $key => $category)
                  <tr>
                    <td>{{$categories->firstItem()+$key}}</td>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->is_header}}</td>
                    <td>
                          @if($category->status == 'Active')
                          <div class="badge badge-success"> Active</div>
                          @else
                          <div class="badge badge-danger"> Inactive</div>
                          @endif
                        </td>
                    <td>
                      <div class="btn-group">
                      	<!-- <a class="btn btn-sm text-dark" href="{{ route('category.edit',$category->id) }}"><i class="fas fa-edit"></i></a> -->
                        <span data-toggle="tooltip" data-placement="top" title="edit" style="margin-top: 3px;">
                          <a href="{{ route('category.edit',$category->id) }}" class="text-dark mt-2"><i class="fas fa-edit"></i></a>
                        </span>

  			          	    <form method="post" action="{{route('category.destroy',$category->id)}}">
                        @csrf
                          <span data-toggle="tooltip" data-placement="top" title="delete">
                            <button type="submit" onclick="return myFunction();" class="btn btn-sm"><i class="fas fa-trash"></i></button>
                          </span>
                        </form>
                      </div>
                    </td>
                  </tr>
                  	@endforeach
                  </tbody>
                </table>
                <div class="float-sm-right mt-3 mr-2"> 
                  {!! $categories->links() !!}
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