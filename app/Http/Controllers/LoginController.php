<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show(Request $request): View
    {
        return view('login');
    }
}
