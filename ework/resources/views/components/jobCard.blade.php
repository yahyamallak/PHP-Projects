@props(['job'])

<div class="w-80 bg-white flex flex-col gap-2 rounded p-4 shadow">
    <div class="w-9/12 m-auto">
        <a href="/jobs/{{$job->id}}">
            <img class="w-full" src="{{ $job->logo ? asset("storage/$job->logo") : asset("images/no-image.png")}}">
        </a>
    </div>
    <div>
        <a href="/jobs/{{$job->id}}"><h2 class="text-base font-bold">{{Str::ucfirst($job->title)}}</h2></a>
        </a>
        <p class="text-sm font-italic text-gray-400">{{Str::ucfirst($job->company)}}</p>
        <p class="text-sm">{{Str::ucfirst($job->location)}}</p>
    </div>
    <div class="flex gap-2">
        @php
            $tags = explode(",", $job->tags)
        @endphp

        @foreach ($tags as $tag)
            <a href="/?tag={{$tag}}"><span class="bg-orange-400 rounded p-2 text-xs cursor-pointer">{{Str::ucfirst($tag)}}</span></a>
        @endforeach
    </div>
    {{$slot}}
</div>
