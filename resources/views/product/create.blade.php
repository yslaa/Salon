@extends('layouts.productmaster')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input id="product" type="text" class="form-control" name="product" autofocus>
                            @error('product')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input id="description" type="text" class="form-control" name="description">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" type="number" class="form-control" name="quantity" min="1" max="50">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="suppliers" >Supplier</label>
                                <select class="form-select form-control" aria-label="Select Supplier" name="suppliers">
                                <option selected>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->supp_id}}">{{$supplier->name}}</option>
                                @endforeach
                                </select>
                        
                                @error('suppliers')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
