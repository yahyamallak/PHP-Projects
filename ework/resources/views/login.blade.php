@extends('layouts.master')


@section('content')


<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4 mt-10">Login</h1>

<form action="/login" method="POST" class="bg-white flex flex-col justify-center gap-2 shadow p-5 rounded mb-[100px] mt-5">
    @csrf


    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-xs">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-2">
        <input type="email" class="w-full p-2 outline-none border-b border-b-orange-500" name="email" placeholder="Your email">
    </div>

    <div class="mb-2">
        <input type="password" class="w-full p-2 outline-none border-b border-b-orange-500" name="password" placeholder="Your password">
    </div>

    <button type="submit" class="bg-orange-500 py-2 px-4 rounded hover:bg-orange-300 mt-2"><i class="fa-solid fa-right-to-bracket"></i> Login</button>

</form>

@endsection
