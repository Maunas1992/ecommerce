@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('product.index')}}">Product</a></li>
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
                  <a href="{{route('product.create')}}" class="btn btn-success">Add Product</a>
                </div>
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
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($products as $product)
                      <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{asset('/storage/product/'.$product->image)}}"class="rounded-circle" height="50px" width="50px"></td>
                        <td>{{$product->p_name}}</td>
                        <td>{{$product->category->category_name ?? '-'}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->qty}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->color}}</td>
                        <td>
                          @if($product->status == 'Active')
                          <div class="badge badge-success"> {{$product->status}}</div>
                          @else
                          <div class="badge badge-danger"> {{$product->status}}</div>
                          @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <!-- <span data-toggle="tooltip" data-placement="top" title="show" style="margin-top: 4px; margin-right: 3px;">
                              <a class="text-dark mr-4" href="{{ route('product.show',$product->id) }}"><i class="fas fa-eye"></i></a>
                            </span> -->

                            <span data-toggle="tooltip" data-placement="top" title="edit" style="margin-top: 3px;">
                              <a class="text-dark mt-2" href="{{ route('product.edit',$product->id) }}"><i class="fas fa-edit"></i></a>
                            </span>
                        
                            <form method="post" action="{{route('product.destroy',$product->id)}}">
                            @method('DELETE')
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
                  {!! $products->links() !!}
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