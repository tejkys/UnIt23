<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuleSet extends Model
{
    protected $table = 'RuleSets';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'company',
        'description_pattern',
    ];
    public function rules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Rule::class, 'rule_set_id', 'id');
    }
}
