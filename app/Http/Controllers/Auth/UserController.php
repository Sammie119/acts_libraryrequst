<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = User::where('id', '!=', 1)->get();

        return view('users', ['users' => $user]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$data['id'].',id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'string'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validator($request->all())->validate();

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'user_type' => $request['user_type'],
            'password' => Hash::make($request['password']),
        ]);

        return back()->with('success', 'User Created Successfully!!');
    }

    public function show($user_id)
    {
        //
    }

    public function update(Request $request, $user_id)
    {
        $this->validator($request->all())->validate();

        if(isset($request->password)){
            User::find($user_id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'user_type' => $request['user_type'],
                'password' => Hash::make($request['password']),
            ]);
        } else {
            User::find($user_id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'user_type' => $request['user_type'],
            ]);
        }

        return back()->with('success', 'User Updated Successfully!!');
    }


    public function destroy($user_id)
    {
        User::find($user_id)->delete();

        return back()->with('success', 'User Deleted Successfully!!');
    }
}

