@extends('layouts.adminmaster')

@section('title')
    Admin Profile Edit
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h1 class="text-center font-weight-bold mb-5">
            Update Admin
        </h1>
        <div class="modal-body mx-3">
            <div class="md-form mb-5">
                <div style="max-width: 40rem; margin: 0 auto;">
                    {{ Form::model($admins, [
                        'route' => ['admin.profileUpdate', $admins->id],
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

                        <div>
                            <label for="images" class="block text-lg pb-3">Admin Picture</label>
                            {{ Form::file('images[]', ['multiple' => true], ['class' => 'block shadow-5xl p-2 my-2 w-full', 'id' => 'images']) }}
                            @if ($admins->images)
                            @foreach (explode('|', $admins->images) as $image)
                                <img src="{{ asset($image) }}" alt="I am A Pic" width="100" height="100" class="ml-24 py-2 w-32 rounded-xl">
                            @endforeach
                        @endif
                            @if ($errors->has('images'))
                                <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                            @endif
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 text-center"> <!-- add text-center class -->
                                {{ Form::submit('Submit', ['class' => 'btn btn-lg btn-success']) }}
                                <a href="{{ url()->previous() }}"
                                   class="btn btn-lg btn-neutral"
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
