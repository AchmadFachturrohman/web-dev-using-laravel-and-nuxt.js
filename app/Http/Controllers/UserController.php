<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    function register(request $request){
        $validator = Validator::make($request->all(), [
            'name'      =>'required|string|max:255',
            'email'     =>'required|string|email|max:255|unique:users',
            'password'  =>'required|string|min:8'
        ]);

        if ($validator -> fails()) {            
            return response()->json([
                'status' => 422,
                'errors' => $validator.messages()
            ], 422);
        }else {
            //buat user baru
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            if ($user) {
                return response()->json([
                    'status'    => 200,
                    'message'   => 'User Created Successfully'
                ],200);
            }else {
                return response()->json([
                    'status'    => 500,
                    'message'   => 'Something Went Wrong !'
                ],500);
            }
        }
    }
}
