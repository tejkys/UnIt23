<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'Rules';
    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'rule_type',
        'rule_set_id',
        'value',
        'resort_id',
    ];
}
