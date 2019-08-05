<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
	use Notifiable;
	
    protected $fillable = [
        'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function profiles(){
        return $this->hasOne('App\Models\Profiles');
    }
	public function accounts(){
        return $this->hasMany('App\Models\Accounts');
    }
}
