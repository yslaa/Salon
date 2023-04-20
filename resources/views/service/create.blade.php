
@extends('layouts.servicemaster')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-body">
                    <form action="{{route('service.store')}}"  method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="service" class="col-md-4 col-form-label text-md-right">Service Name</label>

                            <div class="col-md-6">
                                <input id="service" type="text" class="form-control" name="service"   autofocus>

                                @error('service')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cost" class="col-md-4 col-form-label text-md-right">Service Fee</label>

                            <div class="col-md-6">
                                <input id="cost" type="text" class="form-control" name="cost">

                                @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
