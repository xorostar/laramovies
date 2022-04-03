<div class="mt-4">
    <a href="{{ route('tv.show', $tvShow['id']) }}">
        <img src="{{$tvShow['poster_path']}}" alt="avatar" class='hover:opacity-75 transition ease-in-out duration-150'>
    </a>
    <div class="mt-2">
        <a href='{{ route('tv.show', $tvShow['id']) }}' class='text-lg mt-2 hover:text-gray-300'>
            {{ $tvShow['name'] }}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>
                <i class="fas fa-star text-yellow-500"></i>
            </span>
            <span class='ml-1'>
                {{ $tvShow['vote_average'] }}
            </span>
            <span class='mx-2'>|</span>
            <span>{{ $tvShow['first_air_date'] }}</span>
        </div>
    </div>
    <div class="text-gray-400 text-sm">
        {{ $tvShow['genres'] }}
    </div>
</div>
