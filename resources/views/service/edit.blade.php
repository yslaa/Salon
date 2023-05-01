@extends('layouts.servicemaster')

@section('title')
    Edit Service
@endsection

@section('content')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Edit Service
            </h1>
        </div>
        <div>
            <div class="flex justify-center pt-4">
                {{ Form::model($services, [
                    'route' => ['service.update', $services->id],
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                ]) }}

                    <div class="form-group">
                        <label for="service" class="text-lg">Service Name</label>
                        {{ Form::text('service', null, [
                            'class' => 'form-control',
                            'id' => 'service',
                            'placeholder' => 'Enter Service Name',
                        ]) }}
                        @if ($errors->has('service'))
                            <p class="text-center text-red-500">{{ $errors->first('service') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="cost" class="text-lg">Service Cost</label>
                        {{ Form::text('cost', null, [
                            'class' => 'form-control',
                            'id' => 'cost',
                            'placeholder' => 'Enter Service Cost',
                        ]) }}
                        @if ($errors->has('cost'))
                            <p class="text-center text-red-500">{{ $errors->first('cost') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="product" class="text-lg">Product Needed</label>
                        {{ Form::select('product', $products, $services->product_id, [
                            'class' => 'form-select form-control',
                            'aria-label' => 'Select Product',
                        ]) }}
                        @if ($errors->has('product'))
                            <p class="text-center text-red-500">{{ $errors->first('product') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="employee" class="text-lg">Employee</label>
                        {{ Form::select('employee', $employees, $services->emp_id, [
                            'class' => 'form-select form-control',
                            'aria-label' => 'Select Employee',
                        ]) }}
                        @if ($errors->has('employee'))
                            <p class="text-center text-red-500">{{ $errors->first('employee') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-check-label" for="file">Upload Service Image</label>
                        <input type="file"  id="file" name="img_path" accept='image/*'>
                        @if ($errors->has('img_path'))
                            <p class="text-center text-red-500">{{ $errors->first('img_path') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
