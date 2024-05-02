@extends('layouts.master')


@section('content')

<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4">Add a Job</h1>

<form action="/jobs/create" method="POST" enctype="multipart/form-data" class="bg-white flex flex-col justify-center gap-2 shadow p-5 rounded ">
    @csrf

    <div class="mb-2">
        <label for="title">Job title :</label>
        <input type="text" class="w-full p-2 outline-none border-b border-b-orange-500" name="title" placeholder="Backend Developer" value="{{old('title')}}">
        @error('title')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Company name :</label>
        <input type="text" class="w-full p-2 outline-none border-b border-b-orange-500" name="company" placeholder="YouTube" value="{{old('company')}}">
        @error('company')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Company location :</label>
        <input type="text" class="w-full p-2 outline-none border-b border-b-orange-500" name="location" placeholder="San Fransisco, USA" value="{{old('location')}}">
        @error('location')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Company email :</label>
        <input type="email" class="w-full p-2 outline-none border-b border-b-orange-500" name="email" placeholder="contact@youtube.com" value="{{old('email')}}">
        @error('email')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Company website :</label>
        <input type="url" class="w-full p-2 outline-none border-b border-b-orange-500" name="website" placeholder="https://youtube.com" value="{{old('website')}}">
        @error('website')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Company Logo :</label>
        <input type="file" name="logo">
        @error('logo')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Job description :</label>
        <textarea name="description" class="w-full p-2 outline-none border-b border-b-orange-500" cols="30" rows="10" placeholder="Position, Tasks, Salary...">{{old('description')}}</textarea>
        @error('description')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="title">Tags :</label>
        <input type="text" class="w-full p-2 outline-none border-b border-b-orange-500" name="tags" placeholder="Example: C, Python, Backend..." value="{{old('tags')}}">
        @error('tags')
            <div class="text-red-500 text-xs">{{$message}}</div>
        @enderror
    </div>

    <button type="submit" class="bg-orange-500 py-2 px-4 rounded hover:bg-orange-300 mt-2">Post a job</button>

</form>

@endsection
