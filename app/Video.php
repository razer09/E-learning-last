<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function completion()
    {
        return $this->belongsToMany('App\User', 'completions')
                    ->withTimestamps();
    }

    public function toggelComplete($user)
    {
        $this->completion()->toggle($user);
    }



}

//count of video in course $nbr_lessons
//count of video completed in course By user $nbr_lessons_completed
//Progress = ($completed * 100) / $nbr_lesson
