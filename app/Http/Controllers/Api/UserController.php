<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Course;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\Courses as CoursesResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createdCourses(User $user)
    {
        $courses = $user->createdCourses()->latest()->paginate(8);
        return CoursesResource::collection($courses);
    }

    public function enrolledCourses(User $user)
    {
        $courses = $user->enrolledCourses()->latest()->paginate(8);
        return CoursesResource::collection($courses);
    }

    public function enrollCourse(User $user, Course $course)
    {
        $val = $user->enrollCourse($course);
        return true;
    }

    public function cancelCourse(User $user, Course $course)
    {
        $val = $user->cancelCourse($course);
        return true;
    }

    public function index()
    {
        $user = User::latest()->paginate(8);

        return UserResource::collection($user);
    }

    public function store(Request $request, User $user)
    {
        $this->validateTags();

        $user        = new User;
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->dark_mode = $request->dark_mode;
        $user->full_screen = $request->full_screen;
        $user->first_color = $request->first_color;
        $user->second_color = $request->second_color;
        $user->full_screen = $request->font_size;
        $user->language = $request->language;
        $user->save();

        return new CourseResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $this->validateTags();
        $fileNamePath = 'public/users/';


        $img_path = $request->thubnail;

        if($request->hasFile('thubnail')){
            // Get filename with the extension
            $filenameWithExt = $request->file('thubnail')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('thubnail')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('thubnail')->storeAs($fileNamePath, $fileNameToStore);

            $img_path = '/storage/users/'.$fileNameToStore;
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->thubnail = $img_path;
        $user->dark_mode = $request->dark_mode;
        $user->password = $request->password;
        $user->full_screen = $request->full_screen;
        $user->first_color = $request->first_color;
        $user->second_color = $request->second_color;
        $user->font_size = $request->font_size;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->website = $request->website;
        $user->save();

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return new UserResource($user);
    }

    public function validateTags()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
    }

    public function abilities(User $user)
    {
        // return $user->roles->pluck('name');
        return $user->abilities();
    }
}
