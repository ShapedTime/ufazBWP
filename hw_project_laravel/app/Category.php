<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function accounting(){
        return $this->belongsTo('App\Accounting');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
