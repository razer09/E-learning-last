<?php

namespace App\Http\Controllers\Api;
use App\User;
use App\Course;

use App\Http\Resources\reviews as reviewsResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class reviewsController extends Controller
{
    public function index(Course $course)
    {
        $reviews = $course->reviews()->get();
        // return $reviews;
        return reviewsResource::collection($reviews);
    }

    public function store(Request $request)
    {
        $this->validateTags();
        $user   = User::findOrFail($request->user);
        $course = Course::findOrFail($request->course);

        $enrolledcourse = $user->enrolledCourses()->get([])->pluck('pivot')->pluck('course_id');

        if( $enrolledcourse->contains($course->id) && $user->id != $course->teacher->id){
            $user->addReview($course, $request->rating, $request->review);
            return true;
        }

        abort(403, 'You are not enrolled or you are the creator of course');
    }

    public function delete(User $user, Course $course)
    {
        $user->deleteReview($course);

        return true;
    }

    public function validateTags()
    {
        return request()->validate([
            'course'    => 'required',
            'user'      => 'required',
            'rating'    => 'required',
            'review'    => 'required'
        ]);
    }
}
