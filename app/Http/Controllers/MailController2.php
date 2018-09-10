<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class MailController2 extends Controller
{
    //
    public function index(){
    	return view('mails.mail');
    }
    public function post(Request $req){
    	$req-> validate([
    		'email' => 'required',
    		'subject' => 'required',
    		'message' => 'required',
    	]);
    	$data = [
    		'email' => $req->email,
    		'subject' => $req->subject,
    		'bodyMessage' => $req->message,
    	];

    	//dd($data);
    	Mail::send('mail.mail', $data, function ($message) use ($data) {
    	    $message-> from('phamanhduc536@gmail.com','laravel2');
    	    $message-> to($data['email']);
    	    $message-> subject($data['subject']);
    	});
    	return redirect()->back();
    }
}
