<?php

namespace App\Http\Controllers;

use App\Film;
use App\Actor;
use App\Producer;
use App\Genre;
use App\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $films = Film::with('photo')->orderBy('updated_at','DESC')->withTrashed()->paginate(10);
        $actors = Actor::with('photo')->orderBy('updated_at', 'DESC')->withTrashed()->paginate(10);
        $producers = Producer::orderBy('name','ASC')->paginate(10);
        $genres = Genre::orderBy('updated_at','DESC')->paginate(10);
        $roles = Role::orderBy('updated_at','DESC')->paginate(10);
        return view('home', compact('films','actors','producers','genres','roles'));
    }
}