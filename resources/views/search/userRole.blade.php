@extends('layouts.adminmaster')
@section('title')
    Search User
@endsection
@section('content')
    <div class="container">
        <h1>Search Results</h1>
        <form action="{{ route('search.userRole') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search Users" aria-label="Search by role"
                    aria-describedby="button-search" value="{{ old('search', $searchTerm ?? '') }}">
                <button class="btn btn-outline-secondary" type="submit" id="button-search">Search</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No results found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
