<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Http\Resources\ArticleResource;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get articles
        $articles = PageContent::orderBy('created_at','desc')->paginate(5);
        return ArticleResource::collection($articles);
        // return json_encode($articles,JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('id'))
        {
            $id = $request->input('id');
            $articles =  PageContent::find($id);
            $articles->title = $request->input('title');
            $articles->body = $request->input('body');
            $articles->save();
        }
        else
        {
            $articles = new PageContent;
            $articles->title = $request->input('title');
            $articles->body = $request->input('body');
            $articles->save();
            $id = $articles->id;
        }

        return $id;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articles = PageContent::find($id)->delete();
        return $articles;
    }
}
