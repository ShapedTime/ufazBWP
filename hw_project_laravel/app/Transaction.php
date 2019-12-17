<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'category_id', 'balance_id', 'money', 'comment', 'date'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function balance(){
        return $this->belongsTo('App\Balance');
    }
}
