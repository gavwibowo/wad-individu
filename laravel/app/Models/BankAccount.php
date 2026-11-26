<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'payment_methods';

    protected $fillable = [
        'bank_name',
        'type',
        'account_number',
        'owner_name',
        'logo',
        'status'
    ];
}