<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $table = "books";
    protected $fillable =['id','category_id','name','decription','price','image']; 

   public function category()
   {
     $this->belongsTo('App\Models\category','category_id','id');
   }

}
