@extends('layouts.customermaster')

@section('title')
    Customer Profile Edit
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1 class="text-center font-weight-bold mb-5">
            Update Customer
        </h1>
        <div class="modal-body mx-3">
            <div class="md-form mb-5">
                <div style="max-width: 40rem; margin: 0 auto;">
                    {{ Form::model($customers, [
                        'route' => ['customer.profileUpdate', $customers->id],
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) }}
                    <div class="block">
                        <div class="form-group">
                            <label for="name" class="text-lg">Name</label>
                            {{ Form::text('name', null, [
                                'class' => 'form-control',
                                'id' => 'name',
                            ]) }}
                            @if ($errors->has('name'))
                                <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email" class="text-lg">Email</label>
                            {{ Form::text('email', null, [
                                'class' => 'form-control',
                                'id' => 'email',
                            ]) }}
                            @if ($errors->has('email'))
                                <p class="text-center text-red-500">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="images" class="block text-lg pb-3">Customer Picture</label>
                            {{ Form::file('images', null, ['class' => 'form-control', 'id' => 'images']) }}
                            <img src="{{ asset('images/customer/' . $customers->images) }}" alt="I am A Pic" width="100"
                                height="100" class="ml-24 py-2">
                            @if ($errors->has('images'))
                                <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                            @endif
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                {{ Form::submit('Submit', ['class' => 'btn bg-green-500 p-2 btn-lg btn-block']) }}
                            </div>
                            <div class="col-6">
                                <a href="{{ url()->previous() }}"
                                    class="btn bg-gray-800 text-white font-bold p-2 btn-lg btn-block"
                                    role="button">Cancel</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
