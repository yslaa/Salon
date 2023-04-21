@extends('layouts.adminmaster')

@section('title')
    Show All User Chart
@endsection

@section('content')
    <div style="display: flex; justify-content: center; align-items: center; padding: 3rem;">
        <div style="background: rgba(255, 255, 255, 0.644); border-radius: .75rem; text-align: center; padding: 3rem;">
            <h2 style="font-weight: 700;">All Users Chart</h2>
            @if (empty($UserChart))
                <div></div>
            @else
                <div style="width: 800px; height: 450px;">{!! $UserChart->container() !!}</div>
                {!! $UserChart->script() !!}
            @endif
        </div>
    </div>
@endsection
