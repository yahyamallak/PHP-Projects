@extends('layouts.master')


@section('content')

<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4 mt-10">Job details : </h1>

<x-jobDetails :job="$job"></x-jobDetails>

@endsection
