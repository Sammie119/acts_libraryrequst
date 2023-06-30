<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id', '!=', 1)->get();

        $results = [
            'users' => $user,
        ];
        return view('home', ['results' => $results]);
    }

    public function myProfile()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
//        dd($data);
        if(!isset($data['id'])){
            $data['id'] = 0;
        }

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$data['id'].',id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'string'],
        ]);
    }

    public function storeProfile(Request $request)
    {
        $this->validator($request->all())->validate();

        if(isset($request->password)){
            User::find($request->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'user_type' => $request['user_type'],
                'password' => Hash::make($request['password']),
            ]);
        } else {
            User::find($request->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'user_type' => $request['user_type'],
            ]);
        }

        return back()->with('success', 'User Profile Updated Successfully!!');

    }
}
