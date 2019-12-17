<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function balances(){
        return $this->hasMany('App\Balances');
    }
}
