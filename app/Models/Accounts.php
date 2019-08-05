<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $fillable = [
        'account_type', 'balance', 'is_active'
    ];
	
	public function users(){
        return $this->belongsTo('App\Models\Users');
    }
	
	public function transactions(){
        return $this->hasMany('App\Models\Transactions');
    }
}
