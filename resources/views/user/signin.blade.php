@extends('layouts.guestmaster')

@section('title')
    Login
@endsection

@section('content')
    <div class="row postion:absolute" style="color: white;">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center">Sign In</h1>
            <form action="{{ route('user.signIn') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group text-center">
                    <label for="captcha" class="col-form-label mb-2 text-center">Captcha</label>
                    <div style="display: grid; justify-content:center;">
                        {{-- {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!} --}}
                    </div>
                    @if ($errors->has('g-recaptcha-response'))
                        <div class="text-danger">{{ $errors->first('g-recaptcha-response') }}</div>
                    @endif
                </div>
                <div style="display: grid; justify-content:center;">
                    <input type="submit" value="Sign In" class="btn btn-lg btn-success">
                </div>
            </form>
        </div>
    </div>
@endsection
