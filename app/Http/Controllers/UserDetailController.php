<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\VWUserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    public function index()
    {
        $users = UserDetail::where('user_id', Auth::user()->id)->first();

        $adminUsers = VWUserDetails::where('user_id', '!=', 1)->get();

        return view('user_detail', ['users' => $users, 'adminUsers' => $adminUsers]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        dd($data);
        if(!isset($data['id'])){
            $data['id'] = 0;
        }

        return Validator::make($data, [
            'user_id' => ['required', 'numeric'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'min:10', 'unique:user_details,phone,'.$data['id'].',id'],
            'address' => ['required', 'string'],
            'emg_person' => ['required', 'string'],
            'emg_phone' => ['required', 'numeric', 'min:10', 'unique:user_details,emg_phone,'.$data['id'].',id'],
        ]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

//        dd($request->all());
        UserDetail::updateOrCreate(
            [
                'user_id' => $request['user_id']
            ],
            [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'id_number' => $request['id_number'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'emg_person' => $request['emg_person'],
                'emg_phone' => $request['emg_phone'],
            ]
        );

        return back()->with('success', 'User Details Saved Successfully!!');
    }

    public function destroy($id)
    {
        UserDetail::find($id)->delete();

        return back()->with('success', 'User Details Deleted Successfully!!');
    }
}
