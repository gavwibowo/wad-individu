<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'donations';

    protected $fillable = [
        'campaign_id',
        'campaign_name',
        'amount',
        'payment_method_id',
        'donor_name',
        'status'
    ];

    public $timestamps = false;
}