<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Others extends Controller
{
    //

    function getAllMembers()
    {
        $members = User::where('role', 'member')->get();
        return response($members, 200);
    }
}
