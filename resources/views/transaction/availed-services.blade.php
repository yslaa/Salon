@extends('layouts.customermaster')
@section('title')
    Availed Services
@endsection
@section('content')
@if(Session::has('error'))
<div class="alert alert-warning alert-dismissible  show" role="alert">
    <strong>{{Session::get('error')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
    @if(Session::has('trans'))
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <ul class="list-group">
                    @foreach($services as $service)
                        <li class="list-group-item">
                           
                            <strong>{{ $service['service']['service'] }}</strong>
                            <span class="label label-success">{{ $service['service']['cost'] }}</span>
                            <div class="btn-group" role="group">
                                <div class="p-2 bg-base-100" aria-labelledby="btnGroupDrop1">
                                  <a class="p-2 bg-base-100" href="{{ route('removeService',['id'=>$service['service']['id']]) }}">Remove</a>
                                </div>
                              </div>
                     
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <strong>Total: {{ $totalPrice }}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <a href="{{ route('payment') }}" type="button" class="btn btn-success">Pay</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                <h2>No Availed Service!</h2>
            </div>
        </div>
    @endif
@endsection