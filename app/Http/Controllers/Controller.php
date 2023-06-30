<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\UserDetail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function userDetailID($user_id): int
    {
        return UserDetail::where('user_id', $user_id)->first()->id;
    }

    protected function bookID($barcode): int
    {
        return Book::where('barcode', $barcode)->first()->id;
    }
}
