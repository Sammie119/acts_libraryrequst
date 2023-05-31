<?php

namespace App\Http\Controllers;

use App\Imports\BooksImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title')->paginate(50);
        return view('books', ['books' => $books]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'file' => ['required', 'mimes:xlx,xls,xlsx,ods'],
        ])->validate();

        Excel::import(new BooksImport, $request['file']);
        return back()->with('success', 'Books Uploaded Successfully!');
    }

    public function destroy($id)
    {
        Book::find($id)->delete();

        return back()->with('success', 'Book Deleted Successfully!!');
    }

    public function destroyAll($id)
    {
//        Book::find($id)->delete();
        DB::table('books')->truncate();

        return back()->with('success', 'Books Truncated Successfully!!');
    }
}
