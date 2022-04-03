@extends('layouts.main')

@section('content')
<div class="tv-show-info border-b border-gray-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="{{$tvShow['poster_path']}}" alt="" class='mb-8 md:mb-0 px-8 md:px-0 md:w-96'>
        </div>
        <div class="px-8 md:px-0 md:ml-24">
            <h2 class="text-4xl font-semibold">
                {{ $tvShow['name'] }}
            </h2>
            <div class="flex items-center text-gray-400 text-sm mt-1">
                <span>
                    <i class="fas fa-star text-yellow-500"></i>
                </span>
                <span class='ml-1'>{{ $tvShow['vote_average'] }}</span>
                <span class='mx-2'>|</span>
                <span>{{ $tvShow['first_air_date'] }}</span>
                <span class='mx-2'>|</span>
                <span>{{ $tvShow['genres'] }}</span>
            </div>
            <p class="text-gray-300 mt-8">
                {{ $tvShow['overview'] }}
            </p>
            <div class="mt-12">
                <div class="flex mt-4">
                    @foreach ($tvShow['created_by'] as $crew)
                    <div class='mr-8'>
                        <div>{{ $crew['name'] }}</div>
                        <div class="text-sm text-gray-400">
                            Creator
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div x-cloak x-data='{isOpen: false}'>
                @if (count($tvShow['videos']['results']))
                <div class="mt-12">
                    <button
                        class="inline-flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150"
                        @click='isOpen = true'>
                        <svg class="w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div>
                <div style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show.transition.opacity="isOpen">
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-gray-900 rounded" @click.away="isOpen = false">
                            <div class="flex justify-end pr-4 pt-2">
                                <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                </button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}"
                                        style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

<div class="tv-show-cast border-b border-gray-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($tvShow['cast'] as $cast)
            <div class="mt-8">
                <a href="{{ route('actors.show', $cast['id']) }}">
                    <img src="{{ $cast['profile_path'] }}" alt=""
                        class='hover:opacity-75 transition ease-in-out duration-150'>
                </a>
                <div class="mt-2">
                    <a href="{{ route('actors.show', $cast['id']) }}"
                        class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                    <div class="text-sm text-gray-400">
                        {{ $cast['character'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> <!-- end tv-show-cast -->


    <div class="tv-show-images" x-cloak x-data="{ isOpen: false, image: ''}">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($tvShow['images'] as $image)
                <div class="mt-8">
                    <a href="#" @click.prevent="
                    isOpen = true
                    image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
">
                        <img src="https://image.tmdb.org/t/p/w500/{{$image['file_path']}}" alt=""
                            class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                </div>
                @endforeach
            </div>

            <div style="background-color: rgba(0, 0, 0, .5);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded" @click.away='isOpen = false'>
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                                class="text-3xl leading-none hover:text-gray-300">&times;
                            </button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end tv-show-images -->
    @endsection
