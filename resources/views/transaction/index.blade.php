@extends('layouts.customermaster')
@section('title')
  Services Available
@endsection

{{-- @if (Session::has('success'))
  <div class="alert alert-primary" role="alert">
    <strong>{{Session::get('success')}}</strong>
  </div>
@endif --}}

@section('content')
    @foreach ($services->chunk(2) as $serviceChunk)
        <div class="row">
            @foreach ($serviceChunk as $service)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    {{-- <img src="{{ $item->image_path }}" alt="..." class="img-responsive"> --}}
                    <div class="caption">
                        <h3><strong>{{ $service->service }}</strong><span> ${{ $service->cost }}</span></h3>
                      <p><strong>Employee: </strong>{{ $service->name }}</p>
                      <p><strong>Product: </strong>{{ $service->product }}</p>
                       <div class="clearfix">

                           <a href="{{ route('addAvail', $service->service_id) }}" class="btn btn-primary" role="button" ><i class="fas fa-cart-plus"></i>Add Service</a> 

                           <a href="{{ route('addAvail', $service->service_id)}}" class="btn btn-default pull-right" role="button" {{ $disableButton ? 'disabled' : '' }}><i class="fas fa-info"></i> More Info</a>

                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
    @endforeach
@endsection
