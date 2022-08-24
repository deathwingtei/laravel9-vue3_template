<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PageContent;
use App\Http\Resources\ArticleResource;
use App\Models\WebsiteSetting;
use App\Http\Resources\WebsiteSettingResource;

class IndexController extends Controller
{
    public function index()
    {
        $content_data = PageContent::orderBy('created_at','asc')->get();
        $website_setting_data = WebsiteSetting::orderBy('id','asc')->get();
        $sitedata = array();

        // print_r($content_data);

        foreach ($website_setting_data as $key => $value) {
            if($value->content_size == "no")
            {
                $sitedata[$value->type]['title'] = $value->title;
                $sitedata[$value->type]['image'] = $value->image;
            }
        }

        print_r($sitedata);

        // print_r($content_data);
        // return view('index',compact('content_data','website_setting_data'));
    }
}
