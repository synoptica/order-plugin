<?php

namespace Synoptica\Order\Models;

use Exception;
use Illuminate\Support\Collection;
use Synoptica\Profile\Models\Profile as ProfileBase;

class Profile extends ProfileBase
{
    public $hasMany = [
        'orders' => 'Synoptica\Order\Models\Orders'
    ];
}