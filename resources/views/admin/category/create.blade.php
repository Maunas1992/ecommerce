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
             <!--  <div class="card-header">
                <h3>Create Category</h3>
              </div> -->
              <div class="card-body">
                <form action="{{route('category.store')}}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-6 mb-3">
                      <label>Name: <span class="text-danger">*</span></label>
                      <input type="text" name="category_name" class="form-control" value="{{old('category_name')}}" placeholder="Enter Category Name">
                      <span class="error text-danger">{{$errors->first('category_name')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Is Header: <span class="text-danger">*</span></label>
                      <select name="is_header" class="form-control">
                        <option value="">Select Status</option>
                        <option value="yes" {{ old('is_header') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ old('is_header') == 'no' ? 'selected' : '' }}>No</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('is_header')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{route('category.index')}}" class="btn btn-danger">Cancel</a>
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