<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/popular?page=' . $page)->json()['results'];

        return view('actors.index', new ActorsViewModel($popularActors, $page));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id)->json();

        $social = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id . '/external_ids')->json();

        $credits = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/person/' . $id . '/combined_credits')->json();

        return view('actors.show', new ActorViewModel($actor, $social, $credits));
    }
}
