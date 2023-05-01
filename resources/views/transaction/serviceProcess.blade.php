@extends('layouts.adminmaster')
@section('content')

<div class="w-11/12 mx-auto mt-8 border border-gray-400 rounded-lg p-8">
    <div class="flex justify-between mb-4">
        <h1 class="text-4xl font-bold">Transaction #{{ $customer->id }}</h1>
        <p class="text-gray-600">{{ $customer->date_placed }}</p>
    </div>
    <hr class="border-gray-400 my-4">

    <div class="flex flex-col sm:flex-row justify-between mb-8">
        <div>
            <h2 class="text-xl font-bold mb-2">Customer Info</h2>
            <p><span class="font-bold">Name:</span> {{ $customer->name }}</p>
            <p><span class="font-bold">Email:</span> {{ $customer->email }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <p><span class="font-bold">Amount:</span> {{ $total }}</p>
            <p><span class="font-bold">Status:</span> {{ $customer->Status }}</p>
        </div>
    </div>

    <hr class="border-gray-400 my-4">

    <h2 class="text-xl font-bold mb-4">Services Availed:</h2>
    <br>

    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left font-bold">Service:</th>
                <th class="text-center font-bold">Cost:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avails as $avail)
                <tr>
                    <td class="py-2">{{ $avail->service }}</td>
                    <td class="text-center py-2">{{ $avail->cost }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr class="border-gray-400 my-4">

    {{-- <p class="text-sm text-gray-600">Thank you for choosing our services!</p> --}}

    <div className="col-12 col-lg-3 mt-5">
        <h4 className="my-4">Status</h4>
        <form  action="{{ route('transacUpdate', $customer->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="status">Select Updated Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="Finished">Finished</option>
                    <option value="Canceled">Canceled</option>
                </select>
              </div>
            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </div>

</div>

@endsection
