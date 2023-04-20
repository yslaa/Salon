@extends('layouts.adminmaster')

@section('title')
    Admin Profile
@endsection

@section('content')
<style>
    .align-center {
        text-align: center;
    }

    .hash-list {
        display: block;
        padding: 0;
        margin: 0 auto;
    }

    .hash-list>li {
        display: block;
        float: left;
        background-color: rgba(255, 237, 216);
        border-radius: 1rem;
        padding: 2rem;
    }

    .img {
        border-radius: 75%;
        border: 1px solid rgb(90, 52, 22);
        padding: 5px;
        display: block;
        margin: 0 auto;
    }

    .mgb-20,
    .mgb-20-all>* {
        margin-bottom: 20px;
    }

    .center {
        display: grid;
        justify-content: center;
        margin-top: -5rem;
        font-size: 3rem;
        color: rgba(0, 0, 0, 0.800);
        font-weight: 700;
    }

    .info {
        font-size: 3rem;
        color: rgba(0, 0, 0, 0.800);
        font-weight: 700;
    }

    .text {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    #spam {
        padding: 0 4rem;
    }

    .container {
        background-color: rgba(255, 255, 255, 0.5);
        width: 1-0%;
        max-width: 800px;
        height: fit-content;
        padding: 4rem;
        border-radius: .75rem;
    }

    .container p {
        padding: 1rem 0;
    }
</style>
  



<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card bg-lightbrown">
          <div class="card-header">
            <h1 class="font-cond-l fg-accent lts-md mgb-10">𝐀𝐝𝐦𝐢𝐧 𝐏𝐫𝐨𝐟𝐢𝐥𝐞</h1>
            <h1 class="font-cond-b fg-text-d lts-md fs-300 fs-300-xs no-mg">Welcome to Serenity Salon
              <i style="color:rgb(151, 81, 66)"> {{ $admin->name }}</i>
            </h1>
          </div>
          <div class="card-body">
            <ul class="hash-list cols-4 cols-2-xs pad-30-all align-center text-sm">
              <li>
                <p>Admin Image</p>
                @if ($admin->images)
                  @foreach (explode('|', $admin->images) as $image)
                    <img src="{{ asset($image) }}" alt="I am A Pic" width="100" height="100" class="ml-24 py-2">
                  @endforeach
                @endif
                <br>
                <span id="spam">ID: <i style="color:rgb(151, 81, 66)"> {{ $admin->id }}</i></span>
                <br>
                <span class="fs-110 font-cond-l " contenteditable="false">Role: <i style="color:rgb(151, 81, 66)">{{ $admin->role }}</i></span>
                <br>
                <span id="spam">User ID: <i style="color:rgb(151, 81, 66)">{{ $admin->user_id }}</i></span>
                <br>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  </style>
  

@endsection
