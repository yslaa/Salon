@extends('layouts.servicemaster')
@section('content')
<div class="container text-center">

    <form action="{{route('service.update', $services->id)}}"  method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf

        {{-- <div class="form-group row" >
            <img src="{{asset($product->img_path)}}" alt="" width="100" height="100">
        </div> --}}

        <div class="form-group row">
            <div class="col-md-6">
                <label for="service">Service Name</label>
                <input type="text" class="form-control" id="service"  name="service" placeholder="Enter Service Name" value="{{$services->service}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="cost">Product Cost</label>
                <input type="float" class="form-control" id="cost"  name="cost" placeholder="Enter Product Cost" value="{{$services->cost}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <label for="product">Product Needed</label>
                <select class="form-select form-control" aria-label="Select Product" name="product">
                <option selected>Select Product</option>
                @foreach($products as $product)
                    <option value="{{$product->product_id}}">{{$product->product}}</option>
                @endforeach
                </select>
        
                @error('product')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> 

        @if(Auth::check() && Auth::user()->role === 'admin')

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="employee">Employee</label>
                                <select class="form-select form-control" aria-label="Select Employee" name="employee">
                                <option selected>Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->emp_id}}">{{$employee->name}}</option>
                                @endforeach
                                </select>
                        
                                @error('employee')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
        @endif

        {{-- <div class="form-group row">
            <label class="form-check-label" for="file">Upload roduct Image</label>
          <input type="file"  id="file" name="img_path" accept='image/*'>
        </div> --}}

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection