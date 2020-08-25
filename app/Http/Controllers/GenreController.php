<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $genres = Genre::orderBy('updated_at','DESC')->paginate(10);
        return view('genre.index',compact('genres'));
    }

    public function create()
    {
        return view('genre.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required|min:3|max:20'
        ];

        $messages = [
            'name.min' => 'Genre title should be at least 3 characters long.'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $genre = new Genre(request(['name']));
            $genre->save();
            return redirect('genre')->with('success','Genre Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function show(Genre $genre)
    {
        return view('genre.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('genre.edit',compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->all();

        $rules = [
            'name' => 'required|min:3|max:20'
        ];

        $messages = [
            'name.min' => 'Genre title should be at least 3 characters long.'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $genre->update($data);
            return redirect('genre')->with('success','Genre Edited Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return back()->with('success','Genre Deleted');
    }
}