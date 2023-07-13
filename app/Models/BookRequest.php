<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo('App\Models\Book','book_barcode', 'barcode');
    }
}
