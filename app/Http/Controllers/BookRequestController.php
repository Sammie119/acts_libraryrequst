<?php

namespace App\Http\Controllers;

use App\Imports\BooksImport;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use App\Models\Request as BkRequest;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    public function index()
    {
        if(Auth::user()->user_type === "admin"){
            $requests = BkRequest::orderByDesc('id')->paginate(50);
        } else {
            $requests = BkRequest::where('user_id', Auth::user()->id)->orderByDesc('id')->paginate(50);
        }
        return view('request', ['requests' => $requests]);
    }

    public function store(Request $request)
    {
//        dd($this->bookID($request->barcode));
        BkRequest::updateOrCreate(
            [
                'user_id' => Auth()->user()->id,
                'user_detail_id' => $this->userDetailID(Auth()->user()->id),
                'book_id' => $this->bookID($request->barcode),
                'req_date' => $request['date_t'],
//                'status' => ,
                'requested_created_by' => Auth()->user()->id,
                'requested_updated_by' => Auth()->user()->id,
            ]
        );

        return back()->with('success', 'Book Request was Successfully Saved!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function show(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(BookRequest $bookRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookRequest $bookRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookRequest  $bookRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookRequest $bookRequest)
    {
        //
    }
}
