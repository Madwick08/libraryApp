<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = ['title','author','isbn','published_year','copies_total','copies_available'];
    public function loans(): HasMany { return $this->hasMany(Loan::class); }
}
