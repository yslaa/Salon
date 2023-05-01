@extends('layouts.servicemaster')

@if(Auth::check() && Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
    @section('content')
        <div class="mt-4 mx-4">
            <a href="{{ route('service.create') }}">
                <button class="btn btn-info">
                    Add Service
                </button>
            </a>
        </div>
        <table class="table w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Id</th>
                    <th class="px-4 py-2">Service Name</th>
                    <th class="px-4 py-2">Cost</th>
                    <th class="px-4 py-2">Employee</th>
                    <th class="px-4 py-2">Product Needed</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td class="border px-4 py-2">{{ $service->id }}</td>
                        <td class="border px-4 py-2">{{ $service->service }}</td>
                        <td class="border px-4 py-2">{{ $service->cost }}</td>
                        <td class="border px-4 py-2">{{ $service->name }}</td>
                        <td class="border px-4 py-2">{{ $service->product }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('service.edit', $service->id) }}" class="btn bg-green-500 p-2 mt-2">
                                Edit
                            </a>   
                            <form action="{{ route('service.destroy', $service->id) }}" method="POST" class="inline-block">
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
                        <td class="border px-4 py-2" colspan="6">No Service Data in the Database</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endsection
@else
    @section('content')
        <h1>Page Restricted</h1>
    @endsection
@endif
