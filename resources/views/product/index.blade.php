@extends('layouts.productmaster')
@section('body')
{{-- {{dd(Session::all())}} --}}


<table class="table">
    <thead>
      <tr>
        {{-- <th scope="col">Image</th> --}}
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Date created</th>    
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            {{-- <td><img src="{{asset($product->img_path)}}" alt="" width="200px" height="150px"></td> --}}
            <td>{{$product->id}}</td>
            <td>{{$product->product}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->created_at}}</td>
        </tr>
       @endforeach
   
    </tbody>
  </table>
@endsection