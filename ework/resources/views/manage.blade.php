@extends('layouts.master')


@section('content')

<h1 class="m-5 text-xl font-bold pl-2 border-l-orange-500 border-l-4 mt-10">Manage Jobs</h1>

<div class="flex flex-wrap justify-center gap-4">
    @foreach ($jobs as $job)
    <x-jobCard :job="$job">
        <div class="my-3 flex gap-2 justify-between">
            <a href="manage/edit/{{$job->id}}"><button class="rounded py-2 px-4 bg-slate-200"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
            <form action="manage/{{$job->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="rounded py-2 px-4 bg-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
        </div>
    </x-jobCard>
    @endforeach
</div>

@endsection
