<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function teacher()
    {
        return $this->belongsTo('App\User', 'user_id');// class , foriegn_key
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'enrolled_course')->withTimestamps();
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function videos()
    {
        return $this->hasManyThrough('App\video', 'App\Section');
    }

    //Tags To many Courses
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function assignTag($tag)
    {
        if( is_string($tag)){
            $tag = Tag::Where('name', '=', $tag)->firstOrFail();
        }

        $this->tags()->syncWithoutDetaching($tag);
    }

    public function detachTag($tag)
    {
        if( is_string($tag)){
            $tag = Tag::Where('name', '=', $tag)->firstOrFail();
        }

        $this->tags()->detach($tag);
    }

    //Reviews
    public function reviews()
    {
        return $this->belongsToMany('App\User', 'reviews')
                    ->withTimestamps()
                    ->withPivot(['rating', 'review']);
    }
}
