<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $table = "carts";
    protected $fillable = ['id','user_id','book_id','price'];


    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
}
