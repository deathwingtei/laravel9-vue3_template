<?php

    namespace App\Services;

    use Illuminate\Support\Facades\Storage;

    class WebsiteSettingService
    {
        public function handleUploadedImage($image,$img_name): void
        {
            if (!is_null($image)) {
                
                // $image->move(public_path() . '/images/' , $name);
                $image->storeAs('public/images/', $img_name);
            }
        }
    }