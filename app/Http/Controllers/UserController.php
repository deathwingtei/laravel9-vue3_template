<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        $helper = new Helper;
        $datashow = $helper->callbacktest();
        return view('user')->with("showdata",$datashow);
    }

    public function list()
    {
        //Get users
        $users = User::orderBy('created_at','desc')->where("withdraw",0)->paginate(5);
        return UserResource::collection($users);
        // return json_encode($users,JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        if($request->input('id'))
        {
            $id = $request->input('id');
            $users =  Article::find($id);
            $users->title = $request->input('title');
            $users->body = $request->input('body');
            $users->save();
        }
        else
        {
            $users = new Article;
            $users->title = $request->input('title');
            $users->body = $request->input('body');
            $users->save();
            $id = $users->id;
        }

        return $id;
    }

    public function destroy($id)
    {
        //
        $users = Article::find($id);
        $users->withdraw = 1;
        return $users->save();
        //return $users->delete();
    }
}
