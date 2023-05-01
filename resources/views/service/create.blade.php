@extends('layouts.servicemaster')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex justify-content-center">
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
                        
                        <div class="grid-cols-2 gap-2 w-full d-flex justify-content-center">
                            {{ Form::submit('Submit', ['class' => 'btn bg-green-500 p-2 mt-2 btn-lg  border-gray-300']) }}
                            <a href="{{ url()->previous() }}" class="btn bg-gray-800 text-white p-2 mt-2 text-center btn-lg  border-gray-300"
                                role="button">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
