<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{

    public function index($user_id)
    {
        $courses = User::findOrFail($user_id)->courses;

        return view('course.user.index', compact('courses', 'user_id'));
    }

    public function create($user_id)
    {
        $courses = Course::pluck('id', 'title');
        return view('course.user.create', compact('user_id', 'courses'));
    }

    public function store($user_id, Request $request)
    {

        $course = Course::findOrFail($request->course);
        User::find($user_id)->enrollCourse($course);
        $courses = User::findOrFail($user_id)->courses;
        return view('course.user.index', compact('courses', 'user_id'));
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy($user_id, $course_id, Request $request)
    {
        $course = Course::findOrFail($request->course);
        User::find($user_id)->cancelCourse($course);
        $courses = User::findOrFail($user_id)->courses;
        return view('course.user.index', compact('courses', 'user_id'));
    }
}
