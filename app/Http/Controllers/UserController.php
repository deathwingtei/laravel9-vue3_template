<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

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
        if(Auth::user()->permission!="user")
        {
            return view('user')->with("showdata",$datashow);
        }
        else
        {
            return redirect('/');
        }
    }

    public function list()
    {
        //Get users
        if(Auth::user()->permission=="god")
        {
            $users = User::orderBy('created_at','desc')->where("permission","!=","god")->paginate(5);
        }
        else
        {
            $users = User::orderBy('created_at','desc')->where("permission","!=","god")->where("permission","!=","admin")->paginate(5);
        }
        return UserResource::collection($users);
        // return json_encode($users,JSON_UNESCAPED_UNICODE);
    }

    public function storex(Request $request)
    {
        if($request->input('password')!="")
        {
            $users = new User;
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            $users->password = Hash::make($request->input('password'));
            $users->permission = $request->input('permission');
            $users->save();
            $id = $users->id;
        }
        else
        {
            $id = 0;
        }
        return $id;
    }

    public function store(Request $request)
    {
        if($request->input('id'))
        {
            $id = $request->input('id');
            $users =  User::find($id);
            $users->name = $request->input('name');
            $users->email = $request->input('email');
            if($request->input('password')!="")
            {
                $users->password = ash::make($request->input('password'));
            }
            $users->permission = $request->input('permission');
            $users->save();
        }
        else
        {
            if($request->input('password')!="")
            {
                $users = new User;
                $users->name = $request->input('name');
                $users->email = $request->input('email');
                $users->password = Hash::make($request->input('password'));
                $users->permission = $request->input('permission');
                $users->save();
                $id = $users->id;
            }
            else
            {
                $id = 0;
            }
        }

        return $id;
    }

    public function permission()
    {
        $permission = Auth::user()->permission;
        $data['permission'] = $permission;
        return json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
        if(Auth::user()->permission!="user")
        {
            $users = User::find($id)->delete();
            return $users();
        }
        else
        {
            return redirect('/');
        }
    }
}
