<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use App\Http\Resources\WebsiteSettingResource;
use App\Services\WebsiteSettingService;

class WebsiteSettingController extends Controller
{
    public function __construct(WebsiteSettingService $websiteSettingService)
    {
        $this->websiteSettingService = $websiteSettingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websitesetting = WebsiteSetting::orderBy('created_at','desc')->paginate(15);
        $websitesetting = WebsiteSettingResource::collection($websitesetting);
        return  $websitesetting;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        $websitesetting = WebsiteSetting::where('type','=','page')->get();
        $websitesetting = WebsiteSettingResource::collection($websitesetting);
        return  $websitesetting;
    }

    public function view()
    {
        return view('websitesetting');
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
            $setting =  WebsiteSetting::find($id);
            $setting->title = $request->input('title');
            $setting->type = $request->input('type');
            $setting->content_size = $request->input('content_size');
            if($request->input('editable_data')==""||$request->input('editable_data')=="[]")
            {
                $setting->editable_data = null;
            }
            else
            {
                $setting->editable_data = $request->input('editable_data');
            }
            
            if (!is_null($request->file('image'))) {
                $ext = $request->file('image')->getClientOriginalExtension();
                $img_name = "setting_".rand(0,10000)."_".time().".".$ext;
                $this->websiteSettingService->handleUploadedImage($request->file('image'),$img_name);
                $storageimg_path = "storage/images/".$img_name;
                $setting->image = $storageimg_path;
            }
            $setting->save();
        }
        else
        {
            $setting = new WebsiteSetting;
            $setting->title = $request->input('title');
            $setting->type = $request->input('type');
            $setting->content_size = $request->input('content_size');
            if($request->input('editable_data')==""||$request->input('editable_data')=="[]")
            {
                $setting->editable_data = null;
            }
            else
            {
                $setting->editable_data = $request->input('editable_data');
            }
            if (!is_null($request->file('image'))) {
                $ext = $request->file('image')->getClientOriginalExtension();
                $img_name = "setting_".rand(0,10000)."_".time().".".$ext;
                $this->websiteSettingService->handleUploadedImage($request->file('image'),$img_name);
                $storageimg_path = "storage/images/".$img_name;
                $setting->image = $storageimg_path;
            }
            else
            {
                $setting->image = null;
            }
            $setting->save();
            $id = $setting->id;
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
    }
}
