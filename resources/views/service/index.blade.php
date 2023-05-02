@extends('layouts.servicemaster')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(Auth::check() && Auth::user()->role === 'admin')
    @section('content')
    <p>
        <a href="{{ route('service.create') }}">
            <p class="text-center text-red-700 text-lg bg-purple-500 p-2 mx-3">
                Add Service
            </p>
        </a>
    </p>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>All Services</h1>
            <hr>
           
            {{$dataTable->table()}}
            {{$dataTable->scripts()}}
        </div>
    </div>
    @endsection
@else
    @section('content')
        <h1>Page Restricted</h1>
    @endsection
@endif
