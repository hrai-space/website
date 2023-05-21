<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::paginate(20);
        return view('admin.dashboard')->with('users', $users);
    }
}
