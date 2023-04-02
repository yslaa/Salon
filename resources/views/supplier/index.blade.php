@extends('layouts.adminmaster')

@section('title')
    Supplier Index
@endsection

@section('content')
    <div class="py-3 text-white">
        <table class="table-auto">
            <tr class="text-center">
                <th class="w-screen text-3xl">Supplier Id</th>
                <th class="w-screen text-3xl">Name</th>
                <th class="w-screen text-3xl">Email</th>
                <th class="w-screen text-3xl">Supplier Pic</th>
                <th class="w-screen text-3xl">Update</th>
                <th class="w-screen text-3xl">Delete</th>
                <th class="w-screen text-3xl">Restore</th>
                <th class="w-screen text-3xl">Destroy</th>
            </tr>

            @forelse ($suppliers as $supplier)
                <tr>
                    @if ($supplier->deleted_at)
                        <td class="text-center text-3xl text-red-500">
                            <a href="#">{{ $supplier->id }}</a>
                        </td>
                    @else
                        <td class="text-center text-3xl text-green-500">
                            <a href="{{ route('supplier.show', $supplier->id) }}">{{ $supplier->id }}</a>
                        </td>
                    @endif

                    <td class="text-center text-3xl">
                        {{ $supplier->name }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $supplier->email }}
                    </td>
                    <td class="pl-6">
                        <img src="{{ asset('images/supplier/' . $supplier->images) }}" alt="I am A Pic" width="75"
                            height="75">
                    </td>

                    @if ($supplier->deleted_at)
                        <td>
                            <a href="#" class="text-center text-lg bg-red-600 p-2">
                                Update &rarr;
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="supplier/{{ $supplier->id }}/edit" class="text-center text-lg bg-green-600 p-2">
                                Update &rarr;
                            </a>
                        </td>
                    @endif

                    @if ($admin->deleted_at)
                        <td class=" text-center">
                            {!! Form::open(['route' => ['admin.destroy', $admin->id], 'method' => 'DELETE']) !!}
                            <button disabled class="text-center text-lg bg-yellow-600 p-2">
                                Delete &rarr;
                            </button>
                            {!! Form::close() !!}
                        </td>
                    @else
                        <td class=" text-center">
                            {!! Form::open(['route' => ['admin.destroy', $admin->id], 'method' => 'DELETE']) !!}
                            <button type="submit" class="text-center text-lg bg-yellow-600 p-2">
                                Delete &rarr;
                            </button>
                            {!! Form::close() !!}
                        </td>
                    @endif

                    @if ($supplier->deleted_at)
                        <td>
                            <a href="{{ route('supplier.restore', $supplier->id) }}">
                                <p class="text-center text-red-700 text-lg bg-purple-500 p-2 mx-3">
                                    Restore &rarr;
                                </p>
                            </a>
                        </td>
                    @else
                        <td>
                            <a href="#">
                                <p class="text-center text-lg bg-purple-500 p-2 mx-3">
                                    Restore &rarr;
                                </p>
                            </a>
                        </td>
                    @endif

                    <td>
                        <a href="{{ route('supplier.forceDelete', $supplier->id) }}">
                            <p class="text-center text-lg bg-sky-500 p-2 mx-3"
                                onclick="return confirm('Do you want to delete this data permanently?')">
                                Destroy &rarr;
                            </p>
                        </a>
                    </td>
                </tr>
            @empty
                <p>No Suppliers Data in the Database</p>
            @endforelse
        </table>
    </div>
@endsection
