<?php

    namespace App\Services;

    class ArticleService
    {
        public function handleUploadedImage($image): void
        {
            if (!is_null($image)) {
                $name = time() . $image->getClientOriginalName();
                $image->move(public_path() . '/images/' , $name);
            }
        }
    }