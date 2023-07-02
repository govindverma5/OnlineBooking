<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    public function Book(): BelongsToMany
    {
        return $this->belongsToMany(Book::class,'book_author');
    }
}
