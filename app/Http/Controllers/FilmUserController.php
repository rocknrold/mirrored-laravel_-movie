<?php

namespace App\Http\Controllers;

use App\FilmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FilmUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'comment' => 'required|string'
        ];

        $messages = [
            'comment.required' => 'Please write your comment'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film = new FilmUser;
            $film->comment = $data['comment'];
            $film->film_id = $data['film_id'];
            $film->rating = 0;
            $film->user_id = Auth::user()->id;
            $film->save();
            return back()->with('success','Comment added');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }
}