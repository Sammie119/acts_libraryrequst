<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'barcode' => $row['barcode'],
            'dateaccessioned' => $row['dateaccessioned'],
            'itemcallnumber' => $row['itemcallnumber'],
            'isbn' => $row['isbn'],
            'author' => $row['author'],
            'title' => $row['title'],
            'pages' => $row['pages'],
            'publishercode' => $row['publishercode'],
            'place' => $row['place'],
            'copyrightdate' => $row['copyrightdate'],
        ]);
    }
}
