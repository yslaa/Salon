@extends('layouts.employeemaster')

@section('title')
    Employee Profile
@endsection

@section('content')
<div class="flex justify-center">
  <div class="w-full max-w-lg">
    <div class="card bg-white border border-info shadow-xl flex flex-col h-[500px]" style="border: 4px solid #718096">
      <div class="card-body flex flex-col justify-center items-center text-center">
        <h1 class="text-4xl font-bold text-accent mgb-10" contenteditable="false">𝐄𝐦𝐩𝐥𝐨𝐲𝐞𝐞 𝐏𝐫𝐨𝐟𝐢𝐥𝐞</h1>
        <h2 class="font-inter-bold font-bold text-lg md:text-xl lg:text-2xl mb-8 text-center text-gray-700">
          Welcome to Serenity Salon <i style="color: #28BD5F">{{ $employee->name }}!</i>
      </h2>
        <div class="mx-auto my-10">
          @if ($employee->images)
          <div class="flex justify-center items-center">
            @foreach (explode('|', $employee->images) as $image)
            <div class="avatar mx-2">
              <div class="w-full h-full rounded-full ring ring-primary ring-offset-base-100 ring-offset-2 flex justify-center items-center">
                <img src="{{ asset($image) }}" alt="I am A Pic" class="w-full h-full object-cover">
              </div>
            </div>
            @endforeach
          </div>
          @endif
          <div class="bg-white border rounded-md shadow-lg p-5 mt-7" style="border: 2px solid #718096">
            <div class="flex flex-col space-y-2">
              <div class="font-inter-bold font-bold" id="spam">ID: <span style="color:#28BD5F">{{ $employee->id }}</span></div>
              <div class="font-inter-bold font-bold" id="spam">Role: <span style="color:#28BD5F">{{ $employee->role }}</span></div>
              <div class="font-inter-bold font-bold" id="spam">User ID: <span style="color:#28BD5F">{{ $employee->user_id }}</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
