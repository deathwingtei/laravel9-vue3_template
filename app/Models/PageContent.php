<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
     use HasFactory;
     use SoftDeletes;

     //Table name
     protected $table = 'page_contents';
     //Primary key
     public $primaryKey = 'id';
     //Time Stamps
     public $timestamps = true;
}
