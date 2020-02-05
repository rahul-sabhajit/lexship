<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TrackingStatus extends Model
{
    protected $fillable = [
        'status_name', 'created', 'updated', 'status_code', 'awb_number', 'event_date',
    ];

}
