@extends('layouts.adminmaster')

@section('title')
    Customer Show
@endsection

@section('content')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Show Customers
            </h1>
        </div>
        @forelse ($customers as $customer)
            <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
                <div
                    class="max-w-sm bg-white rounded-lg border border-white-200 shadow-md dark:bg-white-800 dark:border-white-700">
                    @if ($customer->images)
                        <div class="flex justify-center items-center">
                            @foreach (explode('|', $customer->images) as $image)
                                <div class="avatar mx-2">
                                    <div
                                        class="w-full h-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2 flex justify-center items-center">
                                        <img src="{{ asset($image) }}" alt="I am A Pic" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="p-3">
                        <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $customer->name }}
                        </h5>
                        ID<p class="mb-2 text-lg font-bold">{{ $customer->id }}</p>
                        Email<p class="mb-2 text-lg font-bold">{{ $customer->email }}</p>
                    </div>
                </div>
            </section>
            <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                role="button">Back</a>
        @empty
            <p>No customer Data in the Database</p>
        @endforelse
        </table>
    @endsection
