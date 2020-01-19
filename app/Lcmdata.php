<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lcmdata extends Model
{
    protected $fillable = [
        'user_id', 'number', 'lcmtype','calculatedlcm', 'executiontime', 'space','bestmethod', 'bestexecution', 'bestspace',
    ];
}
