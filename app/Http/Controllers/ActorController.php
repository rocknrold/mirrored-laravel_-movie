<?php

namespace App\Http\Controllers;

use App\Actor;
use View;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActorController extends Controller
{
    protected $rules = [
        'name' => 'min:3|max:50|required',
        'note' => 'string|max:300|required',
        'media' => 'required|file|image|dimensions:min_width=100,min_height=200'
    ];

    protected $messages = [
        'name.required' => 'Fill out name',
        'name.max' => 'Maximum name limit exceeds, max of 50 characters only',
        'note.required' => 'Fill out note',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $actors = Actor::with('photo')->orderBy('updated_at', 'DESC')->paginate(10);
        return view('actor\index',compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,$this->rules,$this->messages);

        if ($validator->passes()) {
            $actor = new Actor(request(['name','note']));
            $media = $actor->addMedia($data['media'])->toMediaCollection('actors');
            $actor->save();
            $actor->media_id = $media->id;
            $actor->save();
            return Redirect::route('actor.index')->with('success', 'Actor Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        return view('actor.show')->with('actor',$actor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        return view('actor.edit')->with('actor', $actor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        $data = $request->all();
        $validator = Validator::make($data,$this->rules,$this->messages);

        if ($validator->passes()) {
            $media = $actor->addMedia($data['media'])->toMediaCollection('actors');
            $data['media_id'] = $media->id;
            $actor->update($data);
            return Redirect::route('actor.index')->with('success', 'Actor Updated Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        return Redirect::route('actor.index')->with('success', 'Actor Deleted');
    }
}