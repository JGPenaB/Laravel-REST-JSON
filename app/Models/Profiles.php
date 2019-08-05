<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'address', 'country', 'phone_number', 'zip_code',
    ];
	
	public function users(){
        return $this->belongsTo('App\Models\Users');
    }
}
