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
        $site_data = array();
        $page_data = array();

        // print_r($content_data);

        foreach ($website_setting_data as $key => $value) {
            if($value->content_size == "no")
            {
                $sitedata[$value->type]['title'] = $value->title;
                $sitedata[$value->type]['image'] = $value->image;
            }
        }

        foreach ($content_data as $key => $value) {
            $page_data[$value->website_setting->title]['title'][] = $value->title;
            $page_data[$value->website_setting->title]['body'][] = $value->body;
            $page_data[$value->website_setting->title]['image'][] = $value->image;
        }

        // print_r($content_data);
        return view('index',compact('page_data','sitedata'));
    }
}
