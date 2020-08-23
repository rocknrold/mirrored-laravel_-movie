<?php

namespace App\Http\Controllers;

use App\Producer;
use App\Film;
use App\FilmProducer;
use View;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProducerController extends Controller
{
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

        $rules = [
            'name' => 'required|alpha',
            'email' => 'required|email:rfc,dns',
            'website' => 'required'
        ];

        $messages = [
            'name.required' => 'Name cannot be empty',
            'email.required' => 'Email cannot be empty',
            'website.required' => 'Website cannot be empty',
        ];

        $validator = Validator::make($data,$rules,$messages);

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
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function show(Producer $producer)
    {
        $producer_films = Producer::with(['filmProducers','films'])->get();
        // dd($producer_films);
        foreach ($producer_films as $key => $value) {
            
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producer $producer)
    {
        //
    }
}
