<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
     //Table name
     protected $table = 'article';
     //Primary key
     public $primaryKey = 'id';
     //Time Stamps
     public $timestamps = true;
}
