<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\RuleSet;
use App\Models\User;
use Illuminate\Support\Facades\Http;
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
            return view('index', ["valid"=>false
            ]);
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
        $invoices = array();
        $ruleSets = RuleSet::with('rules')->get();
        foreach (session('objectIds') as $id){
            $invoice = json_decode(
            Http::withUrlParameters([
                'endpoint' => session("companyUrl"),
                'page' => 'faktura-prijata',
                'id' => $id,
                'auth' => session("authSessionId"),
            ])->get('{+endpoint}/{page}/{id}.json?detail=custom:sumCelkem,nazFirmy,popis&authSessionId={auth}'));
            $suitableRuleSet = $ruleSets
                ->where('company', $invoice->winstrom->{'faktura-prijata'}[0]->nazFirmy, )
                ->where('price', $invoice->winstrom->{'faktura-prijata'}[0]->sumCelkem)
                ->filter(function ($item) use ($invoice){
                    return str_contains($invoice->winstrom->{'faktura-prijata'}[0]->popis, $item->description_pattern);
                })
                ->first();
            $invoice->winstrom->{'faktura-prijata'}[0]->suitableRuleSet = $suitableRuleSet;
            $invoices[] = $invoice->winstrom->{'faktura-prijata'}[0];
        }

        $resorts = json_decode(
            Http::withUrlParameters([
                'endpoint' => session("companyUrl"),
                'page' => 'stredisko',
                'auth' => session("authSessionId"),
            ])->get('{+endpoint}/{page}.json?authSessionId={auth}'));

        return view('index', [
            "valid"=> true,
            "invoices" => $invoices,
            "resorts" => $resorts->winstrom->stredisko,
            "ruleSets" => $ruleSets,
        ]);
    }
}
