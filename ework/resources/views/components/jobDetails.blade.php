@props(['job'])

<div class="flex gap-2 bg-white rounded p-4 max-h-fit shadow">
    <div class="flex-1">
        <img class="h-full" src="{{$job->logo ? asset('storage/' . $job->logo) : asset('images/no-image.png')}}">
    </div>
    <div class="flex-1">
        <div class="flex flex-col gap-2 ">
            <h2 class="text-base font-bold">{{$job->title}}</h2>
            <p class="text-sm font-italic text-gray-400">{{$job->company}}</p>
            <p class="text-sm">{{$job->location}}</p>
        </div>
        <div class="overflow-y-auto max-h-80">
            <p>{{$job->description}}</p>
        </div>
        <div>
            <p>{{$job->website}}</p>
            <p>{{$job->email}}</p>
        </div>
        <div class="flex gap-2">
            @php
                $tags = explode(",", $job->tags)
            @endphp

            @foreach ($tags as $tag)
                <a href="/?tag={{$tag}}"><span class="bg-orange-400 rounded p-2 text-xs cursor-pointer">{{Str::ucfirst($tag)}}</span></a>
            @endforeach
        </div>
    </div>
</div>
