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
            if($value->type != "page")
            {
                $sitedata[$value->type]['title'] = $value->title;
                $sitedata[$value->type]['image'] = $value->image;
            }
            else
            {
                $sitedata[$value->type]['title'][] = $value->title;
            }
        }

        foreach ($content_data as $key => $value) {
            if(!isset($num[$value->website_setting->title]))
            {
                $num[$value->website_setting->title] = 0;
            }
            $thisnum = $num[$value->website_setting->title];
            $page_data[$value->website_setting->title][$thisnum]['title'] = $value->title;
            $page_data[$value->website_setting->title][$thisnum]['body'] = $value->body;
            $page_data[$value->website_setting->title][$thisnum]['image'] = $value->image;
            $page_data[$value->website_setting->title][$thisnum]['parent'] = $value->website_setting->title;
            $num[$value->website_setting->title]++;
        }

        return view('index',compact('page_data','sitedata'));
    }
}
