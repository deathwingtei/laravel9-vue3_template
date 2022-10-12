<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;


class ArticleController extends Controller
{
    protected $articleService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function page()
    {
        return view('article');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get articles
        // return json_encode($articles,JSON_UNESCAPED_UNICODE);
        $articles = PageContent::orderBy('created_at','desc')->paginate(15);
        return ArticleResource::collection($articles);
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
            if (!is_null($request->file('file'))) {
                $ext = $request->file('file')->getClientOriginalExtension();
                $img_name = "article_".rand(0,10000)."_".time().".".$ext;
                $this->articleService->handleUploadedImage($request->file('file'),$img_name);
                $storageimg_path = "storage/images/".$img_name;
                $articles->image = $storageimg_path;
            }
            $articles->save();
        }
        else
        {
            $articles = new PageContent;
            $articles->title = $request->input('title');
            $articles->body = $request->input('body');
            if (!is_null($request->file('file'))) {
                $ext = $request->file('file')->getClientOriginalExtension();
                $img_name = "article_".rand(0,10000)."_".time().".".$ext;
                $this->articleService->handleUploadedImage($request->file('file'),$img_name);
                $storageimg_path = "storage/images/".$img_name;
                $articles->image = $storageimg_path;
            }
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
