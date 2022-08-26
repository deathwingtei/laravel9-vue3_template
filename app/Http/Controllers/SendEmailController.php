<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\NotifyMail;
use App\Mail\ThankyouMail;
 
class SendEmailController extends Controller
{
     
    public function index(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $message = $request->input('message');

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'message' => 'required',
        ]);
        
        $mailData = [
            'name' => $name,
            'email' => $email,
            'tel' => $tel,
            'message' => $message
        ];
        

        Mail::to('p.kittichet@gmail.com')->send(new NotifyMail($mailData));
    
        if (Mail::flushMacros()) {
            // return response()->Fail('Sorry! Please try again latter');
            $data = array(
                "success" => 0,
                "return" => "fail",
                "msg" => "Sorry! Please try again latter"
            );
            print_r(json_encode($data, JSON_UNESCAPED_UNICODE));
        }else{
            // return response()->success('Great! Successfully send in your mail');
            $data = array(
                "success" => 1,
                "return" => "success",
                "msg" => "Great! Successfully send in your mail"
            );
            Mail::to($email)->send(new ThankyouMail($mailData));

            print_r(json_encode($data,JSON_UNESCAPED_UNICODE));
        }
    } 
}