<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = [ 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    // All Course
    public function createdCourses()
    {
        return $this->hasMany('App\Course');
    }

    // Courses
    public function enrolledCourses()
    {
        return $this->belongsToMany('App\Course', 'enrolled_course')->withTimestamps();
    }

    public function enrollCourse($course)
    {
        if( is_string($course)){
            $course = Course::Where('title', '=', $course)->firstOrFail();
        }

        $this->enrolledCourses()->syncWithoutDetaching($course);
    }

    public function cancelCourse($course)
    {
        if( is_string($course)){
            $course = Course::Where('title', '=', $course)->firstOrFail();
        }

        $this->enrolledCourses()->detach($course);
    }

    // Roles
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    public function assignRole($role)
    {
        if( is_string($role)){
            $role = Role::Where('name', '=', $role)->firstOrFail();
        }

        $this->roles()->syncWithoutDetaching($role);
    }

    public function detachRole($role)
    {
        if( is_string($role)){
            $role = Role::Where('name', '=', $role)->firstOrFail();
        }

        $this->roles()->detach($role);
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    // Tags
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

    // completion of video
    public function completion()
    {
        return $this->belongsToMany('App\video', 'completions')->withTimestamps();
    }

    public function complete($video)
    {
        if(!$this->completion->contains($video)){
            $this->completion()->attach($video);
        }
    }

    public function incomplete($video)
    {
        $this->completion()->detach($video);
    }

    //Reviews
    public function reviews()
    {
        return $this->belongsToMany('App\Course', 'reviews')
                    ->withTimestamps()
                    ->withPivot(['rating', 'review']);
    }

    public function addReview($course, $rating, $review)
    {
        $this->reviews()->sync([$course->id => ['rating' => $rating, 'review' => $review]]);
    }

    public function deleteReview($course)
    {
        $this->reviews()->detach($course);
    }

}
