@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <h3>Create Product</h3>
              </div>
              <div class="card-body">
                <form action="{{route('product.store')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <input type="text" name="p_name" class="form-control" placeholder="Enter Product Name">
                      <span class="error text-danger">{{$errors->first('p_name')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <textarea name="description" class="form-control" placeholder="Enter Description"></textarea>
                    <span class="error text-danger">{{$errors->first('description')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="file" name="image" class="form-control">
                    <span class="error text-danger">{{$errors->first('image')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="text" name="qty" value="female"> Female <br>
                    <span class="error text-danger">{{$errors->first('qty')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <input type="text" name="price" class="form-control" placeholder="Enter price">
                    <span class="error text-danger">{{$errors->first('price')}}</span>
                    </div>

                    <div class="col-6">
                      <input type="text" name="color" class="form-control" placeholder="Enter color">
                    <span class="error text-danger">{{$errors->first('color')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <select name="category_id">
                        <!-- @foreach($categories as $category) -->
                        <option value=""></option>
                        <!-- @endforeach -->
                      </select>
                    <span class="error text-danger">{{$errors->first('category_id')}}</span>
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