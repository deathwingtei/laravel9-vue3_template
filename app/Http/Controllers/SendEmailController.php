<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\NotifyMail;
 
 
class SendEmailController extends Controller
{
     
    public function index()
    {
 
        $name = $request->input('name');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $message = $request->input('message');
        
        $mailData = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'message' => $message
        ];
        
        Mail::to('p.kittichet@gmail.com')->send(new NotifyMail($mailData));
    
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    } 
}