<?php

namespace App\Http\Controllers;

use App\Imports\BooksImport;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    public function index()
    {
        if(Auth::user()->user_type === "admin"){
            $requests = BookRequest::orderByDesc('id')->paginate(50);
        } else {
            $requests = BookRequest::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(50);
        }
        return view('request', ['requests' => $requests]);
    }

    public function store(Request $request)
    {
//        dd($this->bookID($request->barcode));
        BookRequest::updateOrCreate(
            [
                'user_id' => Auth()->user()->id,
                'user_detail_id' => $this->userDetailID(Auth()->user()->id),
                'book_barcode' => $request->barcode,
                'req_date' => $request['date_t'],
            ]
        );

        return back()->with('success', 'Book Request was Successfully Saved!!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        BookRequest::find($request->id)->update(
            [
                'user_id' => Auth()->user()->id,
                'user_detail_id' => $this->userDetailID(Auth()->user()->id),
                'book_barcode' => $request->barcode,
                'req_date' => $request['date_t'],
            ]
        );

        return back()->with('success', 'Book Request was Successfully Updated!!');
    }

    public function store_approve(Request $request, $id)
    {
        // dd($request->all(), $id);
        BookRequest::find($id)->update(
            [
                'approved_date' => $request['return_date'],
                'days_to_return' => $request['days_r'],
                'date_to_return' => $request['return_date'],
                'status' => 2,
                'approved_created_by' => Auth()->user()->id,
                'approved_updated_by' => Auth()->user()->id,
            ]
        );

        return back()->with('success', 'Book Request was Successfully Approved!!');
    }

    public function cancelRequest(Request $request, $id)
    {
        BookRequest::find($id)->update(
            [
                'approved_date' => now(),
                'status' => 0,
                'approved_created_by' => Auth()->user()->id,
                'approved_updated_by' => Auth()->user()->id,
            ]
        );

        return back()->with('success', 'Book Request was Successfully Cancelled!!');
    }

    public function bookReturned(Request $request, $id)
    {
        BookRequest::find($id)->update(
            [
                'returned_date' => $request['returned_date'],
                'status' => 3,
                'approved_updated_by' => Auth()->user()->id,
            ]
        );

        return back()->with('success', 'Book Request was Successfully Received!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $req = BookRequest::find($id);

        if($req->status === 1) {
            $req->delete();
            return back()->with('success', 'Request Deleted Successfully!!');
        }

        return back()->with('error', 'Request cannot be Deleted!!');
    }
}
