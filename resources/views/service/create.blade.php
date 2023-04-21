
@extends('layouts.servicemaster')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
                    <form action="{{route('service.store')}}"  method="POST" enctype="multipart/form-data"> 
                        @csrf
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="service" >Service Name</label>
                                    <input id="service" type="text" class="form-control" name="service"   autofocus>

                                    @error('service')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="cost" >Service Fee</label>
                                    <input id="cost" type="text" class="form-control" name="cost">

                                    @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="product" >Product Needed</label>
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
                                <label for="employee" >Employee</label>
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
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
