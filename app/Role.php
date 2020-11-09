<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    //roles
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function abilities()
    {
        return $this->belongsToMany('App\Ability')->withTimestamps();
    }


    public function allowTo($ability)
    {
        if( is_string($ability)){
            $ability = Ability::Where('name', '=', $ability)->firstOrFail();
        }

        $this->abilities()->save($ability);
    }
}

//manager => 'esdit', create, ...
