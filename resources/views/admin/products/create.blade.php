@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product Management</h1>
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
            @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif
            <div class="card">
              <form  method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <label>Name: <span class="text-danger">*</span></label>
                      <input type="text" name="p_name" value="{{request()->get('p_name')}}" class="form-control" placeholder="Enter Product Name">
                      <span class="error text-danger">{{$errors->first('p_name')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Description: <span class="text-danger">*</span></label>
                      <textarea name="description" class="form-control" placeholder="Enter Description">{{request()->get('description')}}</textarea>
                    <span class="error text-danger">{{$errors->first('description')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Category: <span class="text-danger">*</span></label>
                      <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ request()->get('category_id') == $category->id ? 'selected' : '' }}> {{$category->category_name}}</option>
                        @endforeach
                      </select>
                    <span class="error text-danger">{{$errors->first('category_id')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Quantity: <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="qty" value="{{request()->get('qty')}}" placeholder="Enter Quantity">
                    <span class="error text-danger">{{$errors->first('qty')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Price: <span class="text-danger">*</span></label>
                      <input type="text" name="price" value="{{request()->get('price')}}" class="form-control" placeholder="Enter price">
                    <span class="error text-danger">{{$errors->first('price')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Color: <span class="text-danger">*</span></label>
                      <input type="text" name="color" value="{{request()->get('color')}}" class="form-control" placeholder="Enter color">
                    <span class="error text-danger">{{$errors->first('color')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Discount: <span class="text-danger">*</span></label>
                      <input type="text" name="discount" value="{{request()->get('discount')}}" class="form-control" placeholder="Enter discount">
                    <span class="error text-danger">{{$errors->first('discount')}}</span>
                    </div>

                    <!-- <div class="col-6">
                      <label>Image: <span class="text-danger">*</span></label>
                      <input type="file" name="image" class="form-control">
                    <span class="error text-danger">{{$errors->first('image')}}</span>
                    </div> -->
                    <div class="col-6">
                      <label>Image: <span class="text-danger">*</span></label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="image" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                      <span class="error text-danger">{{$errors->first('image')}}</span>
                    </div>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ request()->get('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ request()->get('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                      <div class="float-sm-right">
                        <a class="btn btn-success add" id="addRow">
                          <span class="fa fa-plus"></span> &nbsp;Add Row</a>
                      </div>
                    </div>
                  <div class="card-body">
                    <div class="variant">
                      @if(request()->get('productVariant'))
                        @foreach(request()->get('productVariant') as $key => $productVar)
                        <div class="hello">
                          <div class="row">
                            <div class="col-3">
                              <div class="form-group">
                                @if($key == 0)
                                  <label for="exampleFormControlInput1">Color</label>
                                @endif
                                <input type="text" name="productVariant[$key][color]" value="{{$productVar['color']}}" class="form-control" placeholder="Enter Color">
                              <span class="error text-danger">{{$errors->first('productVariant.'.$key.'.color')}}</span>
                              </div>
                            </div>
                            <div class="col-2">
                              <div class="form-group">
                                @if($key == 0)
                                  <label for="exampleFormControlInput1">Quantity</label>
                                @endif
                                <input type="text" name="productVariant[$key][quantity]" value="{{$productVar['quantity']}}" class="form-control" placeholder="Enter Quantity">
                                <span class="error text-danger">{{$errors->first('productVariant.'.$key.'.quantity')}}</span>
                              </div>
                            </div>

                            <div class="col-3">
                              <div class="form-group">
                                @if($key == 0)
                                  <label for="exampleFormControlInput1">Price</label>
                                @endif
                                <input type="text" name="productVariant[$key][price]" value="{{$productVar['price']}}" class="form-control" placeholder="Enter Price">
                                <span class="error text-danger">{{$errors->first('productVariant.'.$key.'.price')}}</span>
                              </div>
                            </div>

                            <div class="col-2">
                              <div class="form-group">
                                @if($key == 0)
                                  <label for="exampleFormControlInput1">Discount</label>
                                @endif
                                <input type="text" name="productVariant[$key][discount]" value="{{$productVar['discount']}}" class="form-control" placeholder="Enter Discount">
                                <span class="error text-danger">{{$errors->first('productVariant.'.$key.'.discount')}}</span>
                              </div>
                            </div>
                            <div class="col-1 ml-2">
                              @if($key == 0)
                                  <label for="exampleFormControlInput1">Remove</label>
                              @endif
                              <button type="button" class="btn btn-danger btn-sm mt-1" onclick="return delete_variant(this);">
                                <span class="fa fa-trash"></span>
                              </button>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      @else
                        <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="exampleFormControlInput1">Color</label>
                            <input type="text" name="productVariant[0][color]" class="form-control" placeholder="Enter Color">
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Quantity</label>
                            <input type="text" name="productVariant[0][quantity]" class="form-control" placeholder="Enter Quantity">
                          </div>
                        </div>

                        <div class="col-3">
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Price</label>
                            <input type="text" name="productVariant[0][price]" class="form-control" placeholder="Enter Price">
                          </div>
                        </div>

                        <div class="col-2">
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Discount</label>
                            <input type="text" name="productVariant[0][discount]" class="form-control" placeholder="Enter Discount">
                          </div>
                        </div>
                      </div>
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3 mb-3">Save</button>
                <a href="{{route('product.index')}}" class="btn btn-danger mb-3">Cancel</a>
              </form>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var index = 1;
  $("#addRow").click(function(){
      html =
        '<div class="hello">' +
          '<div class="row">' +
            '<div class="col-3">' +
              '<div class="form-group">' +
                '<input type="text" name="productVariant['+index+'][color]" class="form-control" placeholder="Enter Color">' +
              '</div>' +
            '</div>' +
            '<div class="col-2">'+
              '<div class="form-group">'+
                '<input type="text" name="productVariant['+index+'][quantity]" class="form-control" placeholder="Enter Quantity">'+
              '</div>'+
            '</div>'+
            '<div class="col-3">'+
              '<div class="form-group">'+
                '<input type="text" name="productVariant['+index+'][price]" class="form-control" placeholder="Enter Price">'+
              '</div>'+
            '</div>'+
            '<div class="col-2">'+
              '<div class="form-group">'+
                '<input type="text" name="productVariant['+index+'][discount]" class="form-control" placeholder="Enter Discount">'+
              '</div>'+
            '</div>'+
            '<div class="col-1 ml-2">'+
              '<button type="button" class="btn btn-danger btn-sm" onclick="return remove_variant(this);">'+
                '<span class="fa fa-trash"></span>'+
              '</button>'+
            '</div>'+
          '</div>'+
        '</div>';
      $('.variant').append(html);
    index++;
    });
  });
</script>
<script type="text/javascript">
  function remove_variant(e) {
            $(e).closest('.hello').remove();
        }
</script>

<script type="text/javascript">
  function delete_variant(e) {
            $(e).closest('.hello').remove();
        }
</script>

@endsection