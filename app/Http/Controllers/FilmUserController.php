<?php

namespace App\Http\Controllers;

use App\FilmUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FilmUserController extends Controller
{
    protected $rules = [
        'comment' => 'required|string|min:3|profanity',
        'rating' => 'required|numeric|min:0|max:10'
    ];

    protected $messages = [
        'comment.required' => 'Please write your comment',
        'comment.profanity' => 'Please do not use bad word',
        'comment.min' => 'Your review should be at least 3 characters long'
    ];

    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request){
        $data = $request->all();
        $badWords = app('profanityFilter')->filter($data['comment'],true);

        $this->messages['comment.profanity'] =
            $this->messages['comment.profanity'].(count($badWords['matched'])==1 ? '':'s').' ('.implode(',',$badWords['matched']).')';
        $validator = Validator::make($data, $this->rules,$this->messages);

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

        $validator = Validator::make($data, $this->rules,$this->messages);

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