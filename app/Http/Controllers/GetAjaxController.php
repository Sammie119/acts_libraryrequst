<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class GetAjaxController extends Controller
{
    public function getBooksDataList(Request $request)
    {
        foreach (Book::get('title')->lazy() as $title) {
            echo'<option>'.$title->title.'</option>';
        }
    }
}
