<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show(Request $request): View
    {
        if(empty($request->query())
            || !array_key_exists("objectId", $request->query())
            || !array_key_exists("authSessionId", $request->query())
            || !array_key_exists("companyUrl", $request->query())

        ){
            return view('index')->with(['message'=>'Vyžadují se parametry pro zpracování položky']);
        }
        session([
                "objectId"=>explode(",",$request->query("objectId")),
                "authSessionId"=> $request->query("authSessionId"),
                "companyUrl"=> $request->query("companyUrl"),
            ]
        );
        return view('index');
    }
}
