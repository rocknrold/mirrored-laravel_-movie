<?php

namespace App\Http\Controllers;

use App\Producer;
use App\Film;
use App\FilmProducer;
use View;
use Redirect;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProducerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required'
        ];

        return $rules;
    }

    public function ruleMessages()
    {
        $messages = [
            'name.required' => 'Name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'website.required' => 'Website cannot be empty',
        ];

        return $messages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producers = Producer::orderBy('name','ASC')->paginate(10);
        return view('producer.index',compact('producers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filmlist = Film::all();

        $films = [];

        foreach ($filmlist as $film) {
            $films[$film->id] = $film->name;
        }

        return view('producer.create', compact('films'));
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

        $validator = Validator::make($data,$this->rules(),$this->ruleMessages());

        if($validator->passes()){
            $producer = new Producer(request(['name','email','website']));
            $producer->save();
            $lastinsert_id = $producer->id;

            $producer_films = [];

            $filmproducer = Producer::find($lastinsert_id);

            foreach ($request->prod_films as $id) { 
                $producer_films[] = new FilmProducer([
                    'film_id' => $id,
                    'producer_id' => $lastinsert_id
                ]);
            }

            $filmproducer->filmProducers()->saveMany($producer_films);

            return redirect('/producer')->with('success','Producer Added Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    /**
     * Display the specified resource.
     *
     // * @param  \App\Producer  $producer
     // * @return \Illuminate\Http\Response
     */
    public function show(Producer $producer)
    {
        $producer_films = $producer->filmProducers()->with(['film'])->get();
        return view('producer.show',compact('producer','producer_films'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function edit(Producer $producer)
    {
        $filmlist = Film::all();

        $films = [];

        foreach ($filmlist as $film) {
            $films[$film->id] = $film->name;
        }

        return view('producer.edit', compact('producer','films'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producer $producer)
    {
        $data = $request->all();

        $validator = Validator::make($data,$this->rules(),$this->ruleMessages());

        if($validator->passes()){
            $producer->update($data);
            $lastupdate_id = $producer->id;

            $producer_films = [];

            foreach ($request->prod_films as $key) {
              $data = array(                 
                  'film_id'=>$key,
                  'producer_id'=>$lastupdate_id,                   
              );   
                DB::table('film_producers')->updateOrInsert($data);
            } 

            // foreach ($request->prod_films as $key) {
            //   $data = array(                 
            //       'film_id'=>$key,
            //       'producer_id'=>$lastupdate_id,                   
            //   );   
            //     $producer->filmProducers()->sync($data);
            // }


            return redirect('/producer')->with('success','Producer Updated Successfully');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producer $producer)
    {
        $producer->delete();
        return Redirect::route('producer.index')->with('success','Producer Deleted');
    }
}
