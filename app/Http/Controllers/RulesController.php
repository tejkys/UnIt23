<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\RuleSet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RulesController extends Controller
{
    public function getSets(Request $request)
    {
        return RuleSet::all();
    }
    public function removeSet(Request $request)
    {
        Rule::where('rule_set_id',$request->id)->delete();
        RuleSet::where('id', $request->id)->delete();
        return RuleSet::all();
    }
    public function removeRule(Request $request)
    {
        Rule::where('id',$request->id)->delete();
    }
    public function addRule(Request $request){
        $rule = new Rule();
        $rule->rule_type = $request->rule_type;
        $rule->value = $request->value;
        $rule->rule_set_id = $request->rule_set_id;
        $rule->resort_id = $request->resort_id;
        $rule->save();
    }
    public function addRuleSet(Request $request){

        $ruleSet = new RuleSet();
        $ruleSet->name = $request->name;
        $ruleSet->company = $request->company;
        $ruleSet->description_pattern = $request->description_pattern;
        $ruleSet->price = $request->price;
        $ruleSet->save();
        foreach ($request->rules as $rule){
            $rule = new Rule();
            $rule->ruled_type =$rule["usedRule"];
            $rule->resort_id =$rule["resortId"];
            $rule->rule_set_id = $ruleSet->id;
            $rule->value =$rule["price"];
            $rule->save();
        }
    }
}
