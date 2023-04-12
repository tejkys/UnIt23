<?php

namespace App\Http\Controllers;

use App\Models\RuleSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class TestingController extends Controller
{
    /*
        $response->ok() : bool;                  // 200 OK
        $response->created() : bool;             // 201 Created
        $response->accepted() : bool;            // 202 Accepted
        $response->noContent() : bool;           // 204 No Content
        $response->movedPermanently() : bool;    // 301 Moved Permanently
        $response->found() : bool;               // 302 Found
        $response->badRequest() : bool;          // 400 Bad Request
        $response->unauthorized() : bool;        // 401 Unauthorized
        $response->paymentRequired() : bool;     // 402 Payment Required
        $response->forbidden() : bool;           // 403 Forbidden
        $response->notFound() : bool;            // 404 Not Found
        $response->requestTimeout() : bool;      // 408 Request Timeout
        $response->conflict() : bool;            // 409 Conflict
        $response->unprocessableEntity() : bool; // 422 Unprocessable Entity
        $response->tooManyRequests() : bool;     // 429 Too Many Requests
        $response->serverError() : bool;         // 500 Internal Server Error
    */
    public function get(Request $request)
    {
        $ruleSet = new RuleSet();
        $ruleSet->name = "a";
        $ruleSet->company = "b";
        $ruleSet->description_pattern = "b";
        $ruleSet->price = 0;
        $ruleSet->save();

        //$response = Http::get('http://example.com');
//        Http::withUrlParameters([
//            'endpoint' => 'https://laravel.com',
//            'page' => 'docs',
//            'version' => '9.x',
//            'topic' => 'validation',
//        ])->get('{+endpoint}/{page}/{version}/{topic}');

        // Basic authentication...
        //$response = Http::withBasicAuth('taylor@laravel.com', 'secret')->post(/* ... */);

        // Digest authentication...
        //$response = Http::withDigestAuth('taylor@laravel.com', 'secret')->post(/* ... */);

        //Bearer
        //$response = Http::withToken('token')->post(/* ... */);

        //Post
//        $response = Http::post('http://example.com/users', [
//            'name' => 'Steve',
//            'role' => 'Network Administrator',
//        ]);

        return "asd";
    }
    public function post(Request $request){
        return strtoupper($request->value);
    }
    public function view(Request $request)
    {
        return view('test');
    }
}
