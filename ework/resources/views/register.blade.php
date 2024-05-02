@extends('layouts.master')


@section('content')


<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4 mt-10">Register</h1>


<form action="/register" method="POST" class="bg-white flex flex-col justify-center gap-2 shadow p-5 rounded mb-[50px] mt-5">
    @csrf
    <div class="mb-2">
        <input type="text" class="w-full p-2 outline-none border-b border-b-orange-500" name="name" placeholder="Your name">
        @error('name')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <input type="email" class="w-full p-2 outline-none border-b border-b-orange-500" name="email" placeholder="Your email">
        @error('email')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <input type="password" class="w-full p-2 outline-none border-b border-b-orange-500" name="password" placeholder="Your password">
        @error('password')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <input type="password" class="w-full p-2 outline-none border-b border-b-orange-500" name="password_confirmation" placeholder="Password confirmation">
        @error('password_confirmation')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <button type="submit" class="bg-orange-500 py-2 px-4 rounded hover:bg-orange-300 mt-2"><i class="fa-solid fa-user-plus"></i> Register</button>

</form>


@endsection
