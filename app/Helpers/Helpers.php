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

    function loadDiagnosisAll()
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
