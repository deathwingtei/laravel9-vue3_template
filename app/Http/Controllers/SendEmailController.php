<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Mail;
 
use App\Mail\NotifyMail;
 
 
class SendEmailController extends Controller
{
     
    public function index(Request $request)
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
        
        $data = array(
            "success" => 0,
            "return" => $name,
            "msg" => "Sorry! Please try again latter"
        );

        Mail::to('p.kittichet@gmail.com')->send(new NotifyMail($mailData));
    
        if (Mail::flushMacros()) {
            // return response()->Fail('Sorry! Please try again latter');
            $data = array(
                "success" => 0,
                "return" => response(),
                "msg" => "Sorry! Please try again latter"
            );
            print_r(json_encode($data, JSON_UNESCAPED_UNICODE));
        }else{
            // return response()->success('Great! Successfully send in your mail');
            $data = array(
                "success" => 1,
                "return" => response(),
                "msg" => "Great! Successfully send in your mail"
            );
            print_r(json_encode($data,JSON_UNESCAPED_UNICODE));
        }
    } 
}