<?php

namespace Post\Http\Controllers;

use Illuminate\Http\Request;

use Post\Http\Requests;
use Post\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        echo $user['name'].'登录成功！';
    }
}
