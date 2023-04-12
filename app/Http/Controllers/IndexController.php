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
            || !(array_key_exists("objectId", $request->query()) || array_key_exists("objectIds", $request->query()))
            || !array_key_exists("authSessionId", $request->query())
            || !array_key_exists("companyUrl", $request->query())

        ){
            $request->session()->flash('message','Vyžadují se parametry pro zpracování položky!');
            return view('index');
        }
        $ids = array();
        if(array_key_exists("objectIds", $request->query())){
            $ids = array_merge($ids, explode(",", $request->query("objectIds")));
        }
        if(array_key_exists("objectId", $request->query())){
            $ids[] = $request->query("objectId");
        }

        session([
                "objectIds"=> $ids,
                "authSessionId"=> $request->query("authSessionId"),
                "companyUrl"=> $request->query("companyUrl"),
            ]
        );
        return view('index');
    }
}
