@extends('layouts.master')


@section('content')

<h1>Welcome {{Auth::user()->name}} </h1>

@endsection
