@extends('layouts.adminmaster')

@section('title')
    Admin Index
@endsection

@section('content')
    <div>
        {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
@endsection
