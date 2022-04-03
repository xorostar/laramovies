<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;
    public $page;

    public function __construct($popularActors, $page)
    {
        $this->popularActors = $popularActors;
        $this->page = $page;
    }

    public function popularActors()
    {
        return collect($this->popularActors)->map(fn ($actor) => collect($actor)->merge([
            'profile_path' => $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w235_and_h235_face/' . $actor['profile_path'] : 'https://ui-avatars.com/api?size=235&name=' . $actor['name'],
            'known_for' => collect($actor['known_for'])->map(fn ($knownFor) => collect($knownFor)->merge([
                'title' => $knownFor['media_type'] == 'tv' ? $knownFor['name'] : $knownFor['title']
            ]))->pluck('title')->implode(', ')
        ])->only([
            'name', 'id', 'profile_path', 'known_for'
        ]));
    }

    public function previous()
    {
        return $this->page > 1 ? $this->page - 1 : null;
    }

    public function next()
    {
        return $this->page < 500 ? $this->page + 1 : null;
    }
}
