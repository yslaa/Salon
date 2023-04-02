@extends('layouts.adminmaster')

@section('title')
    Employee Show
@endsection

@section('content')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Show Employees
            </h1>
        </div>
        @forelse ($employees as $employee)
            <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
                <div
                    class="max-w-sm bg-white rounded-lg border border-white-200 shadow-md dark:bg-white-800 dark:border-white-700">
                    <img src="{{ asset('images/employee/' . $employee->images) }}" alt="I am A Pic" width="400"
                        style="max-height: 12rem;">
                    <div class="p-3">
                        <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $employee->name }}
                        </h5>
                        ID<p class="mb-2 text-lg font-bold">{{ $employee->id }}</p>
                        Email<p class="mb-2 text-lg font-bold">{{ $employee->email }}</p>
                        Role<p class="mb-2 text-lg font-bold">{{ $employee->employee_role }}</p>
                    </div>
                </div>
            </section>
            <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                role="button">Back</a>
        @empty
            <p>No Employee Data in the Database</p>
        @endforelse
        </table>
    @endsection
