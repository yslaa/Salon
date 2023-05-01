@extends('layouts.customermaster')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Transaction History</h1>
            <hr>
           
            {{$dataTable->table()}}
            {{$dataTable->scripts()}}
        </div>
    </div>

@endsection
