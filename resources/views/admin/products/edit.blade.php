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
            <div class="card">
              <!-- <form action="{{route('product.update',$products->id)}}" method="POST" enctype="multipart/form-data"> -->
              <form action="{{route('product.edit',$products->id)}}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  @csrf
                  <div class="row">
                    <div class="col-6">
                      <label>Name: <span class="text-danger">*</span></label>
                      <input type="text" name="p_name" value="{{ request()->get('p_name') ? request()->get('p_name') : $products->p_name}}" class="form-control" placeholder="Enter Product Name">
                      <span class="error text-danger">{{$errors->first('p_name')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Description: <span class="text-danger">*</span></label>
                      <textarea name="description" class="form-control" placeholder="Enter Description">{{ request()->get('description') ? request()->get('description') : $products->description}}</textarea>
                    <span class="error text-danger">{{$errors->first('description')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Category: <span class="text-danger">*</span></label>
                      <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ request()->get('category_id') ? request()->get('category_id') : $category->id}}" {{ $products->category_id == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
                        @endforeach
                      </select>
                    <span class="error text-danger">{{$errors->first('category_id')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Quantity: <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="qty" value="{{ request()->get('qty') ? request()->get('qty') : $products->qty}}" placeholder="Enter Quantity">
                    <span class="error text-danger">{{$errors->first('qty')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Price: <span class="text-danger">*</span></label>
                      <input type="text" name="price" value="{{ request()->get('price') ? request()->get('price') : $products->price}}" class="form-control" placeholder="Enter price">
                    <span class="error text-danger">{{$errors->first('price')}}</span>
                    </div>

                    <div class="col-6">
                      <label>Color: <span class="text-danger">*</span></label>
                      <input type="text" name="color" value="{{ request()->get('color') ? request()->get('color') : $products->color}}" class="form-control" placeholder="Enter color">
                    <span class="error text-danger">{{$errors->first('color')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Discount: <span class="text-danger">*</span></label>
                      <input type="text" name="discount" value="{{ request()->get('discount') ? request()->get('discount') : $products->discount}}" class="form-control" placeholder="Enter discount">
                    <span class="error text-danger">{{$errors->first('discount')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Status: <span class="text-danger">*</span></label>
                      <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Active" {{ request()->get('status') == 'Active' ? 'selected' : '' }} {{ $products->status == 'Active' ? 'selected' : ''  }}>Active</option>
                        <option value="Inactive"{{ request()->get('status') == 'Inactive' ? 'selected' : '' }} {{ $products->status == 'Inactive' ? 'selected' : ''  }}>Inactive</option>
                      </select>
                      <span class="error text-danger">{{$errors->first('status')}}</span>
                    </div>

                    <div class="col-6 mb-3">
                      <label>Image: <span class="text-danger">*</span></label>
                      <input type="file" name="image" class="form-control mb-3">
                      <img src="{{asset('/storage/product/'.$products->image)}}" class="rounded-circle" height="100px" width="100px">
                    <!-- <span class="error text-danger">{{$errors->first('image')}}</span> -->
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      @if($productVariantCount == 0)
                      <h3 class="card-title mt-2">This Product haven't Variant, Please Add</h3>
                      @endif
                      <div class="card-tools">
                        <div class="float-sm-right">
                          <a class="btn btn-success add" id="addRow">
                              <span class="fa fa-plus"></span> &nbsp;Add Row</a>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="variant">
                        @if(request()->get('productVariant'))
                          @foreach(request()->get('productVariant') as $variantkey => $product_var)
                            <div class="row productVar">
                              <input type="hidden" class="variants_key" value="{{$variantkey}}">
                              @if(isset($product_var['variant_id']))
                              <input type="hidden" name="productVariant[{{ $variantkey }}][variant_id]" value="{{$product_var['variant_id']}}">
                              @endif
                                <div class="col-3">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Color</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][color]" value="{{$product_var['color']}}" class="form-control" placeholder="Enter Color">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.color')}}</span>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Quantity</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][quantity]" value="{{$product_var['quantity']}}" class="form-control" placeholder="Enter Quantity">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.quantity')}}</span>
                                  </div>
                                </div>

                                <div class="col-3">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Price</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][price]" value="{{$product_var['price']}}" class="form-control" placeholder="Enter Price">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.price')}}</span>
                                  </div>
                                </div>

                                <div class="col-2">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Discount</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][discount]" value="{{$product_var['discount']}}" class="form-control" placeholder="Enter Discount">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.discount')}}</span>
                                  </div>
                                </div>

                                <div class="col-1 ml-1">
                                  @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Remove</label>
                                  @endif
                                  <button type="button" class="btn btn-danger btn-sm" onclick="return remove_variant(this);">
                                    <span class="fa fa-trash"></span>
                                  </button>
                                </div>
                            </div>
                          @endforeach
                        @else
                          @foreach($productVariant as $variantkey => $product_var)
                            <div class="row productVar">
                              <input type="hidden" class="variants_key" value="{{$variantkey}}">
                              @if(isset($product_var['variant_id']))
                              <input type="hidden" name="productVariant[{{ $variantkey }}][variant_id]" value="{{$product_var['variant_id']}}">
                              @endif
                                <div class="col-3">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Color</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][color]" value="{{$product_var['color']}}" class="form-control" placeholder="Enter Color">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.color')}}</span>
                                  </div>
                                </div>
                                <div class="col-2">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Quantity</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][quantity]" value="{{$product_var['quantity']}}" class="form-control" placeholder="Enter Quantity">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.quantity')}}</span>
                                  </div>
                                </div>

                                <div class="col-3">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Price</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][price]" value="{{$product_var['price']}}" class="form-control" placeholder="Enter Price">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.price')}}</span>
                                  </div>
                                </div>

                                <div class="col-2">
                                  <div class="form-group">
                                    @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Discount</label>
                                    @endif
                                    <input type="text" name="productVariant[{{$variantkey}}][discount]" value="{{$product_var['discount']}}" class="form-control" placeholder="Enter Discount">
                                    <span class="error text-danger">{{$errors->first('productVariant.'.$variantkey.'.discount')}}</span>
                                  </div>
                                </div>

                                <div class="col-1 ml-1">
                                  @if($variantkey == 0)
                                      <label for="exampleFormControlInput1">Remove</label>
                                    @endif
                                  <button type="button" class="btn btn-danger btn-sm" onclick="return remove_variant(this);">
                                    <span class="fa fa-trash"></span>
                                  </button>
                                </div>
                            </div>
                          @endforeach
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3 mb-3">Update</button>
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
  @php
  $variant_count = count($productVariant);
  @endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    var index = '<?php echo $variant_count; ?>';
    $("#addRow").click(function(){
    html = '<div class="productVar"><div class="row"><div class="col-3"><div class="form-group"><input type="text" name="productVariant['+index+'][color]" class="form-control" placeholder="Enter Color"></div></div>';

    html += '<div class="col-2"><div class="form-group"><input type="text" name="productVariant['+index+'][quantity]" class="form-control" placeholder="Enter Quantity"></div></div>';

    html += '<div class="col-3"><div class="form-group"><input type="text" name="productVariant['+index+'][price]" class="form-control" placeholder="Enter Price"></div></div>';

    html += '<div class="col-2"><div class="form-group"><input type="text" name="productVariant['+index+'][discount]" class="form-control" placeholder="Enter Discount"></div></div>';

    html += '<div class="col-1 ml-2"><button type="button" class="btn btn-danger btn-sm" onclick="return remove_variant(this);"><span class="fa fa-trash"></span></button></div></div></div>';

$('.variant').append(html);

index++;
  });
});
</script>

  <script type="text/javascript">
  function remove_variant(e) {
            $(e).closest('.productVar').remove();
        }
  </script>
@endsection