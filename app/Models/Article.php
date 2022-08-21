<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
     use HasFactory;
     use SoftDeletes;

     //Table name
     protected $table = 'article';
     //Primary key
     public $primaryKey = 'id';
     //Time Stamps
     public $timestamps = true;
}
