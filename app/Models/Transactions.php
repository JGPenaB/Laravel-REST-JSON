<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'amount', 'description',
    ];
	
	public function accounts(){
        return $this->belongsTo('App\Models\Accounts');
    }
}
