<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function createUser(Request $request)
    {
        $user = new User();
        $user->username = 'something';
        $user->password = Hash::make('userpassword');
        $user->email = 'useremail@something.com';
        $user->save();

        // TODO: User Created

        return response()->json("Done");
    }
}
