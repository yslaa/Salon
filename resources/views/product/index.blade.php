@extends('layouts.productmaster')
@section('content')
    <p>
        <a href="{{ route('product.create') }}">
            <p class="text-center text-red-700 text-lg bg-purple-500 p-2 mx-3">
                Add Product
            </p>
        </a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Product</th>
                <th scope="col">Description</th>
                {{-- <th scope="col">Image</th> --}}
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>

                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product }}</td>
                    <td>{{ $product->description }}</td>
                    {{-- <td><img src="{{url($product->img_path)}}" alt="" width="150px" height="100px"></td> --}}
                    <td>

                    <td><a href="{{-- route('product.edit',$product->id) --}}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{-- route('product.destroy',$product->id) --}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-trash" style="color:red"></i>
                            </button>
                        </form>
                    </td>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
