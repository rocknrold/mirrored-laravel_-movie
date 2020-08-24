<?php

namespace App\Http\Controllers;

use App\Film;
use App\Actor;
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
        return view('home', compact('films','actors'));
    }
}