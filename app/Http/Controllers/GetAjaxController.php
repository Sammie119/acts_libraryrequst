<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class GetAjaxController extends Controller
{
    public function getBooksTitleList(Request $request)
    {
        foreach (Book::get('title')->lazy() as $title) {
            echo'<option>'.$title->title.'</option>';
        }
    }

    public function getBooksAuthorList(Request $request)
    {
        foreach (Book::get('author')->lazy() as $title) {
            echo'<option>'.$title->author.'</option>';
        }
    }

    public function getBooksDetail(Request $request)
    {
        $bk_dt = '%'.$request->search.'%';

        $book = Book::where('title', 'like', "$bk_dt")->orWhere('author', 'like', "$bk_dt")->first();
        if($book){
            $results = [
                'barcode' => $book->barcode,
                'isbn' => explode(" ", $book->isbn)[0],
                'author' => $book->author,
                'title' => $book->title,
            ];

        }
        else{
            $results = [
                'barcode' => 'none',
                'response' => "",
            ];
        }

        return response()->json($results);
    }
}
