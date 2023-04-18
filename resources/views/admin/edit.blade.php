@extends('layouts.adminmaster')

@section('title')
    Admin Edit
@endsection

@section('content')
    <div class="pb-20 my-2">
        <div class="text-center">
            <h1 class="text-5xl">
                Update Admins
            </h1>
        </div>
        <div>
            <div class="flex justify-center pt-4">
                {{ Form::model($admins, [
                    'route' => ['admin.update', $admins->id],
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                ]) }}
                <div class="block">
                    <div>
                        <label for="name" class="text-lg">Name</label>
                        {{ Form::text('name', null, [
                            'class' => 'block shadow-5xl p-2 my-2 w-full',
                            'id' => 'name',
                        ]) }}
                        @if ($errors->has('name'))
                            <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="text-lg">Email</label>
                        {{ Form::text('email', null, [
                            'class' => 'block shadow-5xl p-2 my-2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    w-full',
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
                                <img src="{{ asset($image) }}" alt="I am A Pic" width="100" height="100"
                                    class="ml-24 py-2">
                            @endforeach
                        @endif
                        @if ($errors->has('images'))
                            <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>


                    <div class="grid grid-cols-2 gap-2 w-full">
                        {{ Form::submit('Submit', ['class' => 'btn bg-green-500 p-2 mt-5 btn-lg btn-block']) }}
                        <a href="{{ url()->previous() }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endsection
