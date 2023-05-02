@extends('layouts.productmaster')

@section('content')
    <div class="mt-4 mx-4">
        <a href="{{ route('product.create') }}">
            <button class="btn btn-info">
                Add Product
            </button>
        </a>
    </div>
    <table class="table w-full mt-4">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Product</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>

                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>

                    <td>

                    <td><a href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-trash" style="color:red"></i> 
                            </button>
                        </form>                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2" colspan="5">No Product Data in the Database</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
