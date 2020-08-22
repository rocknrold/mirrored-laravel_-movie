<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\ContactAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(){
        $adminEmail = User::select('email')->where('is_admin','=',TRUE)->get();
        if($adminEmail->count()==0){
            return view('contact.index');
        }
        $adminEmail = array_values($adminEmail->toArray()[0])[0];
        return view('contact.index',compact('adminEmail'));
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            'subject' => 'required|min:3|string',
            'message' => 'required|min:3',
            'to' => 'required|exists:users,email'
        ];

        $messages = [
            'subject.required' => 'Please fill in the subject field',
            'message.required' => 'Please fill in the message field',
            'to.exists' => 'The email provided is not included in the registered users'
        ];

        $validator = Validator::make($data,$rules,$messages);

        if($validator->passes()){
            Mail::to($request->input('to'))
                ->send(new ContactAdmin($request->input('subject'), $request->input('message')));
            return back()->with('success', 'Email Successfully Sent!');
        }

        $errors = $validator->messages();

        return back()->withErrors($errors)->withInput($data);
    }
}