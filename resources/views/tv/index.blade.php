@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-14">
    <div class="popular-tv">
        <h2 class="uppercase tracking-wider text-yellow-500 mb-8 text-lg font-semibold">Popular Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularTv as $tvShow)
            <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
    <div class="now-playing mt-16 py-16">
        <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Top Rated Shows</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRatedTv as $tvShow)
            <x-tv-card :tvShow="$tvShow" />
            @endforeach
        </div>
    </div>
</div>
@endsection
