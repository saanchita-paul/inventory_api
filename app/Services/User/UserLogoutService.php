<?php

namespace App\Services\User;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class UserLogoutService
{
    /**
     * User Logout Service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function userLogout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response ([
            'message' =>'Successfully Logged Out'
        ]);
    }

}
