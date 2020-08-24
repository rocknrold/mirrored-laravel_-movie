<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'subject' => 'required|min:3|string',
            'message' => 'required|min:3'
        ];

        $messages = [
            'subject.required' => 'Please fill in the subject field',
            'message.required' => 'Please fill in the message field'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            Mail::to('152b8ec449-612108@inbox.mailtrap.io')
                ->send(new ContactAdmin($request->input('subject'), $request->input('subject')));
            return back()->with('success', 'Thank you for contact us!');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }
}
