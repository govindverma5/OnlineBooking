<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    public function Author(): BelongsToMany
    {
        return $this->belongsToMany(Author::class,'book_author');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Review()
    {
        return $this->hasMany(Review::class);
    }

}
