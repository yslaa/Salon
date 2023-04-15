@extends('layouts.productmaster')
@section('content')
<div class="container">

    <form action="{{route('product.update', $products->id)}}"  method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf

        {{-- <div class="form-group row" >
            <img src="{{asset($product->img_path)}}" alt="" width="100" height="100">
        </div> --}}

        <div class="form-group row">
          <label for="product">Product Name</label>
          <input type="text" class="form-control" id="product"  name="product" placeholder="Enter Product Name" value="{{$products->product}}">
        </div>

        <div class="form-group row">
          <label for="description">Country</label>
          <input type="text" class="form-control" id="description" placeholder="Description" name="description" value="{{$products->description}}">
        </div>

        <div class="form-group row">
            <label for="cost">Product Cost</label>
            <input type="float" class="form-control" id="cost"  name="cost" placeholder="Enter Product Cost" value="{{$products->cost}}">
        </div>

        <div class="form-group row">
            <label for="quantity">Product Quantity</label>
            <input type="number" class="form-control" id="quantity"  name="quantity" placeholder="Enter Product Quantity" value="{{$products->quantity}}">
        </div>

        {{-- <div class="form-group row">
            <label class="form-check-label" for="file">Upload roduct Image</label>
          <input type="file"  id="file" name="img_path" accept='image/*'>
        </div> --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection