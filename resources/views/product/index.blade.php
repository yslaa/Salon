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
                <th class="px-4 py-2">Id</th>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->id }}</td>
                    <td class="border px-4 py-2">{{ $product->product }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('product.edit', $product->id) }}" class="btn bg-green-500 p-2 mt-2">
                            Edit
                        </a>   
                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline-block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn bg-gray-800 text-white font-bold p-2 mt-2">
                                Delete
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
