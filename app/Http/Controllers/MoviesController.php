<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/popular')->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/genre/movie/list')->json()['genres'];

        $nowPlayingMovies = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/now_playing')->json()['results'];

        $viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $genres);

        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/movie/' . $id . '?append_to_response=videos,images,credits')->json();

        return view('movies.show', new MovieViewModel($movie));
    }
}
