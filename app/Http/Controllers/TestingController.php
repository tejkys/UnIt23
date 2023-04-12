<?php

namespace App\Http\Controllers;

use App\Models\RuleSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TestingController extends Controller
{

    public function get(Request $request)
    {

    }
    public function post(Request $request){
        return strtoupper($request->value);
    }
    public function view(Request $request)
    {

        return view('test');
    }
}
