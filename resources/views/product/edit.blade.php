@extends('layouts.productmaster')

@section('title')
    Products Edit
@endsection
@section('content')
<div class="pb-20 my-2">
  <div class="text-center">
      <h1 class="text-5xl">
          Edit Products
      </h1>
  </div>
  <div>
      <div class="flex justify-center pt-4">
                {{ Form::model($products, [
                    'route' => ['product.update', $products->id],
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                ]) }}


                    <div>
                        <label for="product" class="text-lg">Product Name</label>
                        {{ Form::text('product', null, [
                            'class' => 'block shadow-5xl p-2 my-2 w-full border border-gray-300',
                            'id' => 'product',
                        ]) }}
                        @if ($errors->has('product'))
                            <p class="text-center text-red-500">{{ $errors->first('product') }}</p>
                        @endif
                    </div>

                    <div>
                      <label for="description" class="text-lg">Description</label>
                      {{ Form::text('description', null, [
                          'class' => 'block shadow-5xl p-2 my-2 w-full border border-gray-300',
                          'id' => 'description',
                      ]) }}
                      @if ($errors->has('description'))
                          <p class="text-center text-red-500">{{ $errors->first('description') }}</p>
                      @endif
                  </div>

                  <div>
                      <label for="quantity" class="text-lg">Quantity</label>
                      {{ Form::number('quantity', null, [
                          'class' => 'block shadow-5xl p-2 my-2 w-full border border-gray-300',
                          'id' => 'quantity',
                      ]) }}
                      @if ($errors->has('quantity'))
                          <p class="text-center text-red-500">{{ $errors->first('quantity') }}</p>
                      @endif

                  


                    <div class="grid-cols-2 gap-2 w-full">
                        {{ Form::submit('Submit', ['class' => 'btn bg-green-500 p-2 mt-5 btn-lg btn-block border border-gray-300']) }}
                        <a href="{{ url()->previous() }}" class="btn bg-gray-800 text-white p-2 mt-5 text-center btn-block btn-lg btn-block border border-gray-300"
                            role="button">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endsection






