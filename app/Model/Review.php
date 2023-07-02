<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    //
    protected $fillable = ['review','rating','user_id','book_id'];

    public function User()
    {
        return $this->belongsTo("App\User");
    }   

    public function Book()
    {
        return $this->belongsTo("App\Model\Book");
    }   
}
