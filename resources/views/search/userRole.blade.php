@extends('layouts.adminmaster')

@section('title')
    Search User
@endsection

@section('content')
    <div class="container my-4 p-3 border bg-secondary" style="margin: 0 auto; max-width: 800px;">
        <form action="{{ route('search.userRole') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search Users" aria-label="Search by role"
                    aria-describedby="button-search" value="{{ old('search', $searchTerm ?? '') }}" style="width: 350px">
                <button class="btn btn-outline-secondary" type="submit" id="button-search"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg></button>
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
                            <td>{{ $user->
                            name }}</td>
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
