<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageSubscription extends Model
{
    protected $fillable = [
        'name', 'amount','user_id','status', 'expirydate',
    ];
}
