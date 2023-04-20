@extends('layouts.servicemaster')

@if(Auth::check() && Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
    @section('content')
    <p>
        <a href="{{ route('service.create') }}">
            <p class="text-center text-red-700 text-lg bg-purple-500 p-2 mx-3">
                Add Service
            </p>
        </a>
    </p>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Service Name</th>
                <th scope="col">Cost</th>
                {{-- <th scope="col">Image</th> --}}
                <th scope="col">Employee</th>
                <th scope="col">Product Needed</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>

                    <td>{{ $service->id }}</td>
                    <td>{{ $service->service }}</td>
                    <td>{{ $service->cost }}</td>
                    <td>{{ $service->employee_id }}</td>
                    <td>{{ $service->product_id }}</td>
                    {{-- <td><img src="{{url($service->img_path)}}" alt="" width="150px" height="100px"></td> --}}
                    <td>

                    {{-- <td><a href="{{route('service.edit', $service->id)}}"><i class="fas fa-edit"></i></a></td>
                    <td>
                        <form action="{{ route('service.destroy',$service->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-trash" style="color:red"></i>
                            </button>
                        </form>
                    </td>
                    </td> --}}

                </tr>
            @endforeach

        </tbody>
    </table>

    @endsection
@else
    @section('content')
    <h1>Page Restricted</h1>
    @endsection
    @endif
   
