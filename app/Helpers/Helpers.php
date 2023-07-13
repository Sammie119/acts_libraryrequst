<?php

use App\Models\Book;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;

    function checkUserDetails()
    {
        if(Auth::check()){
            $user = UserDetail::where('user_id', Auth::user()->id)->first();

            if(empty($user)){
                echo '
                <script type="text/javascript">
                    alert("Kindly Complete User Detail Form at User Details");
                </script>
                ';

            }

        }
    }

    function homePageData()
    {
        $users = User::count() - 1;

        $books = Book::count();

        return [
          'users' => $users,
          'books' => $books,
        ];
    }

    function loadTitleAll()
    {
        echo '
            <script type="text/javascript">
                setTimeout(() => {
                    var search = 1;

                    $.ajax({
                        type:"POST",
                        url:"get-books-title",
                        headers: {
                            "X-CSRF-TOKEN": $(\'meta[name="csrf-token"]\').attr("content")
                        },
                        data: {
                            search
                            },
                        success:function(data) {
                            $("#booksSel").empty();
                            $("#booksSel").html(data);
                        }
                    });
                }, 1000);
            </script>
        ';
    }

    function loadAuthorAll()
    {
        echo '
                <script type="text/javascript">
                    setTimeout(() => {
                        var search = 1;

                        $.ajax({
                            type:"POST",
                            url:"get-books-author",
                            headers: {
                                "X-CSRF-TOKEN": $(\'meta[name="csrf-token"]\').attr("content")
                            },
                            data: {
                                search
                                },
                            success:function(data) {
                                $("#booksAuthorSel").empty();
                                $("#booksAuthorSel").html(data);
                            }
                        });
                    }, 1000);
                </script>
            ';
    }

    function status($num)
    {
        return match ($num) {
            0 => 'Cancelled',
            1 => 'Pending',
            2 => 'Approved',
            3 => 'Returned',
            default => "No Status",
        };

    }

    function getBook($barcode)
    {
        return Book::where('barcode', $barcode)->first();
    }

    function getDaysDiff($older_date, $current_date)
    {
        $date_diff = strtotime($current_date) - strtotime($older_date);

        if(round($date_diff / (60 * 60 * 24)) >= 1){
            return round($date_diff / (60 * 60 * 24));
        }

        return 0;
    }
