@extends('layouts.master')


@section('content')

@include("partials._search")

<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4">Latest Jobs</h1>



<div class="flex flex-wrap justify-center gap-4">
    @foreach ($jobs as $job)
    <x-jobCard :job="$job"></x-jobCard>
    @endforeach
</div>


<div class="mt-5">
    {{$jobs->links()}}
</div>


@auth
<div class="fixed bottom-5 right-5">
    <a href="/jobs/create">
        <p class="rounded bg-orange-500 py-2 px-4 hover:bg-orange-300"><i class="fa-solid fa-pen-to-square"></i> Post a Job</p>
    </a>
</div>
@endauth

@endsection
