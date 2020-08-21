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
            'comment' => 'required|string|min:3',
            'rating' => 'required|numeric|min:0|max:10'
        ];

        $messages = [
            'comment.required' => 'Please write your comment',
            'comment.min' => 'Your review should be at least 3 characters long'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film = new FilmUser;
            $film->comment = $data['comment'];
            $film->film_id = $data['film_id'];
            $film->rating = $data['rating'];
            $film->user_id = Auth::user()->id;
            $film->save();
            return back()->with('success','Comment added');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function update(Request $request, FilmUser $film){
        $data = $request->all();

        $rules = [
            'comment' => 'required|string|min:3',
            'rating' => 'required|numeric|min:0|max:10'
        ];

        $messages = [
            'comment.required' => 'Please write your comment',
            'comment.min' => 'Your review should be at least 3 characters long'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            $film->where([['film_id','=',$data['film_id']],['user_id','=',Auth::user()->id]])
                ->update(['comment'=>$data['comment'], 'rating'=>$data['rating']]);
            return back()->with('success','Comment edited');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    public function destroy($film){
        $filmUser = new FilmUser;
        $filmUser->remove($film);
        return back()->with('success','Comment Deleted');
    }
}
