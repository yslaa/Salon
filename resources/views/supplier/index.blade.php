@extends('layouts.adminmaster')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Suppliers</div>
            <div class="card-body">
                {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush