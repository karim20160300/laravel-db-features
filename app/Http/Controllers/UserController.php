<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Media;
class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        // this function without any validation or any real images just for using polymerphic relations and understand it
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Media::create([
            'model_id' => $user->id,
            'model_name' => 'App\Models\User',
            'file' => $request->file,
        ]);

        return 'created successfully!';
    }
}
