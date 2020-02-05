<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'order_id', 'awb_number', 'vendor_json', 'created_at', 'updated_at',
    ];
}
