<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use View;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $films = Film::orderBy('updated_at','DESC')->paginate(10);
        return view('film.index',compact('films'));
    }

    public function create()
    {
        $allGenres = Genre::all();

        $genres = [];
        foreach($allGenres as $genre){
            $genres[$genre->id] = $genre->name;
        }
        return view('film.create',compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
            'story' => 'required',
            'released_at' => 'required',
            'duration' => 'required',
            'info' => 'required',
            'genre' => 'required'
        ];

        $messages = [
            'name.required' => 'Please fill in the name field'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film = new Film(request(['name','story','released_at','duration','info']));
            $film->save();
            return redirect('/film')->with('success','Film Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function show(Film $film)
    {
        return view('film.show',compact('film'));
    }

    public function edit(Film $film)
    {
        $allGenres = Genre::all();

        $genres = [];
        foreach($allGenres as $genre){
            $genres[$genre->id] = $genre->name;
        }

        $film->released_at = date('Y-m-d\TH:i:s',strtotime($film->released_at));
        return view('film.edit',compact('film','genres'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required',
            'story' => 'required',
            'released_at' => 'required',
            'duration' => 'required',
            'info' => 'required'
        ];

        $messages = [
            'name.required' => 'Please fill in the name field'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film->update($data);
            return redirect('/film')->with('success','Film Updated Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return Redirect::route('film.index')->with('success','Film Deleted');
    }


}
