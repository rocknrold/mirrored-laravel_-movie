<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use App\Certificate;
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
        $allCertificates = Certificate::all();

        $genres = [];
        $certificates = [];

        foreach($allGenres as $genre){
            $genres[$genre->id] = $genre->name;
        }

        foreach($allCertificates as $certificate){
            $certificates[$certificate->id] = $certificate->name;
        }

        return view('film.create',compact('genres','certificates'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $rules = [
            'name' => 'min:3|max:100|required',
            'story' => 'min:10|required',
            'released_at' => 'date|date_format:Y-m-d\TH:i|required',
            'duration' => 'numeric|digits:2|min:60|max:180|required',
            'info' => 'min:3|required',
            'genre_id' => 'numeric|exists:genres,id|required',
            'certificate_id' => 'numeric|exists:certificates,id|required'
        ];

        $messages = [
            'name.min' => 'Film title should be at least 3 characters long.',
            'info.min' => 'Film additional information should be at least 3 characters long.'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film = new Film(request(['name','story','released_at','duration','info','genre_id']));
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
        $allCertificates = Certificate::all();

        $genres = [];
        $certificates = [];

        foreach($allGenres as $genre){
            $genres[$genre->id] = $genre->name;
        }

        foreach($allCertificates as $certificate){
            $certificates[$certificate->id] = $certificate->name;
        }

        $film->released_at = date('Y-m-d\TH:i:s',strtotime($film->released_at));
        return view('film.edit',compact('film','genres','certificates'));
    }

    public function update(Request $request, Film $film)
    {
        $data = $request->all();

        $rules = [
            'name' => 'min:3|max:100|required',
            'story' => 'min:10|required',
            'released_at' => 'date|date_format:Y-m-d\TH:i|required',
            'duration' => 'numeric|digits:2|min:60|max:180|required',
            'info' => 'min:3|required',
            'genre_id' => 'numeric|exists:genres,id|required',
            'certificate_id' => 'numeric|exists:certificates,id|required'
        ];

        $messages = [
            'name.min' => 'Film title should be at least 3 characters long.',
            'info.min' => 'Film additional information should be at least 3 characters long.'
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