<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search;
    public $show = false;

    public function updatingSearch()
    {
        $this->search = true;
    }

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) > 2) {
            $searchResults = collect(Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/movie?query=' . $this->search)->json()['results'])->take(7);
        }

        return view('livewire.search-dropdown', ['searchResults' => collect($searchResults)]);
    }
}
