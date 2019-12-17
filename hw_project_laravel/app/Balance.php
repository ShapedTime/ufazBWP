<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{

    protected $fillable = [
        'user_id', 'payment_method_id', 'name', 'money', 'currency'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function payment_method(){
        return $this->belongsTo('App\PaymentMethod');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
