@extends('layouts.guestmaster')

@section('title')
    Employee Register
@endsection

@section('content')
    <div class="container" style="color:white;">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="text-center">Employee Register</h1>

                <form action="{{ route('employee.register') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="email">Email: </label><i style="color:red">*</i>
                        <input type="text" name="email" id="email" class="form-control">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label><i style="color:red">*</i>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name: </label><i style="color:red">*</i>
                        <input type="text" name="name" id="name" class="form-control">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="employee_role" class="control-label">Employee Role:</label><i style="color:red">*</i>
                        <div class="form-group">
                            <select class="form-control" name="employee_role">
                                @if ($errors->has('employee_role'))
                                    <small>{{ $errors->first('employee_role') }}</small>>
                                @endif
                                <option value="Veterinarian">Veterinarian</option>
                                <option value="Groomer">Groomer</option>
                                <option value="Assistant">Assistant</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="images" class="control-label">Employee Profile:</label><i style="color:red"></i>
                        <input type="file" class="form-control" id="images" name="images">
                        @error('images')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" value="Sign Up" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
