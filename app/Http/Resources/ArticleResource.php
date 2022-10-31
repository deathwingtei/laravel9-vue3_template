<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image,
            'page_id' => $this->page_id,
            'website_setting_title' => $this->website_setting->title,
            'website_setting_type' => $this->website_setting->type,
            'website_setting_content_size' => $this->website_setting->content_size,
            'website_setting_editable_data' => $this->website_setting->editable_data,
        ];
    }
}
