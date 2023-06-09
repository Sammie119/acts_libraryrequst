<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class FormRequestController extends Controller
{
    public function getCreateModalData($data)
    {
        return match ($data) {
            'new_user' => view('forms.input.user_form'),
            'upload_books' => view('forms.input.books_upload'),
            'new_request' => view('forms.input.request_form'),
            default => "No Form Selected",
        };
    }

    public function getEditModalData($data, $id)
    {
        switch ($data) {
            case 'edit_user':
                return view('forms.input.user_form', ['user' => User::find($id)]);
                break;
            case 'edit_user_detail':
                return view('forms.input.user_detail_form', ['users' => UserDetail::find($id)]);
                break;
            case 'edit_request':
                $req = BookRequest::find($id);
                if($req->status === 1){
                    return view('forms.input.request_form', ['request' => BookRequest::find($id)]);
                }
                return "Approved/Cancelled requested Book cannot be Edited!!";
                break;
            case 'approve_request':
                return view('forms.input.approve_request_form', ['request' => BookRequest::find($id)]);
                break;
            default:
                return "No Form Selected";
        };
    }

    public function getViewModalData($data, $id)
    {
        return match ($data) {
            'new_user' => view('forms.input.user_form'),
            'new_drug' => view('forms.input.drug_form'),
            'drug_transaction' => view('forms.input.drug_transaction_form'),
            default => "No Form Selected",
        };
    }

    public function getDeleteModalData($data, $id)
    {
        return match ($data) {
            'delete_user' => view('forms.delete.delete-user', ['id' => $id]),
            'delete_user_detail' => view('forms.delete.delete-user-detail', ['id' => $id]),
            'delete_book' => view('forms.delete.delete-book', ['id' => $id]),
            'delete_all_books' => view('forms.delete.delete-book-all', ['id' => $id]),
            'delete_request' => view('forms.delete.delete-request', ['id' => $id]),
            'cancel_request' => view('forms.delete.cancel-request', ['id' => $id]),
            'returned_request' => view('forms.delete.received-request', ['id' => $id]),
            default => "No Form Selected",
        };
    }
}
