<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function profile(Request $request){
        return response()->json([
            'firstname' => $request->user()->firstname,
            'email' => $request->user()->email
        ]);
    }
}
