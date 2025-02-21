<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // User yaratish (Create)
    public function store(RegisterRequest $request)
    {
       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function index()
    {
        return response()->json(User::all());
    }

  
}

}
