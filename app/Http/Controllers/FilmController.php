<?php

namespace App\Http\Controllers;

use App\Film;
use App\FilmUser;
use App\Genre;
use App\Certificate;
use View;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

        $rules = [
            'name' => 'required|min:3|max:100',
            'story' => 'required|min:10',
            'released_at' => 'required|date',
            'duration' => 'required|numeric|digits_between:2,3|min:60|max:180',
            'info' => 'required|min:3',
            'genre_id' => 'required|numeric|exists:genres,id',
            'certificate_id' => 'required|numeric|exists:certificates,id',
            'media' => 'required|file|image|dimensions:min_width=100,min_height=200'
        ];

        $messages = [
            'name.min' => 'Film title should be at least 3 characters long.',
            'info.min' => 'Film additional information should be at least 3 characters long.'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film = new Film(request(['name','story','released_at','duration','info','genre_id','certificate_id']));
            $film->addMedia($data['media'])->toMediaCollection('movie');
            $film->save();
            // dd($film->getKey());
            // $film->media_id = $media->id;
            return redirect('/film')->with('success','Film Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function show(Film $film)
    {
        $comments = $film->filmUsers()->with('user')->get();
        // $f = Film::find(33);
        // dd((($f->getMedia('movie')->toArray()[0]))['id']);
        // dd(Media::find(8));
        // dd($film->getPhotoUrlAttribute);
        $media = ($film->getMedia('movie'));

        if(count($media) == 0){
            $media = asset('logo-01.jpg');
        } else {
            $media = $media[0]->getUrl('thumb');
        }
        $hasComment = false;
        $user_id = Auth::user()->id;
        $rating = round($comments->avg('rating'),2);
        $now = now('Asia/Manila');
        return view('film.show',compact('film','comments','hasComment','rating','now','media'));
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
            'name' => 'required|min:3|max:100',
            'story' => 'required|min:10',
            'released_at' => 'required|date',
            'duration' => 'required|numeric|digits_between:2,3|min:60|max:180',
            'info' => 'required|min:3',
            'genre_id' => 'required|numeric|exists:genres,id',
            'certificate_id' => 'required|numeric|exists:certificates,id'
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
