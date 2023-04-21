@extends('layouts.adminmaster')

@section('title')
    Admin Profile
@endsection

@section('content')
<div class="flex justify-center">
  <div class="w-full max-w-lg">
    <div class="card bg-white shadow-xl flex flex-col md:flex-row h-[500px]">
      <figure class="mx-auto pt-10">
        @if ($admin->images)
        @foreach (explode('|', $admin->images) as $image)
          <img src="{{ asset($image) }}" alt="I am A Pic" width="100" height="100" class="mx-auto my-2 rounded-full avatar">
        @endforeach
        @endif
      </figure>
      <div class="card-body flex flex-col justify-center items-center text-center">
        <h2 class="card-title">Shoes!</h2>
        <p class="card-text">If a dog chews shoes whose shoes does he choose?</p>
        <div class="card-actions">
          <button class="btn btn-primary">Buy Now</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
