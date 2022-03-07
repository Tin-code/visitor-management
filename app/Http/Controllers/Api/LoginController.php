<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    public function store(Request $request)
     {        $this->validate($request,[
         'email'=>'required',
         'password'=>'required',
        ]);
        if(!auth()->attempt($request->only('email','password')))
        {            throw new AuthenticationException();        }
         return
          [ "token" => auth()->user()->createToken($request->deviceId)->plainTextToken ];
        }

    public function destroy(Request $request)
    {       auth()->user()->tokens()->where('name',$request->deviceId)->delete();
    }
}
