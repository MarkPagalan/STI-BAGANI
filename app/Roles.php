<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'user_id', 'role_id',
    ];
    public function users()
    {
        //return $this
            //->belongsToMany('App\User')('Role', 'users_roles');
            //->withTimestamps();
        return $this->belongsToMany('App\Users', 'roleusers');
    }
}
