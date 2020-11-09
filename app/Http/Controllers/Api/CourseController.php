<?php
namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Course;
use App\User;
use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\Courses as CoursesResource;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::latest()->paginate(8);

        return CoursesResource::collection($course);
    }

    public function store(Request $request)
    {
        $this->validateModel();

        $course_id = Course::get()->last()->id;
        $course_id ++;
        $fileNamePath = 'public/courses/'.$course_id.'/images';

        $img_path = '/storage/courses/default_image.png';

        if ($request->hasFile('thubnail')) {
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
            $img_path = '/storage/courses/'.$course_id.'/images/'.$fileNameToStore;
        }

        $course                 = new Course;
        $course->user_id        = $request->user_id;
        $course->title          = $request->title;
        $course->description    = $request->description;
        $course->thubnail       = $img_path;
        $course->old_price      = $request->old_price;
        $course->price          = $request->price;
        $course->save();

        return new CourseResource($course);
    }


    public function show(Course $course)
    {
        return new CourseResource($course);
    }


    public function update(Request $request, Course $course)
    {
        $this->validateModel();

        $course_id = $course->id;

        $fileNamePath = 'public/courses/'.$course_id.'/images';

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

            $img_path = '/storage/courses/'.$course_id.'/images/'.$fileNameToStore;

            // Delete file if exists
            Storage::delete($fileNamePath.'/.$course->thubnail');
        }

        $course->user_id        = $request->user_id;
        $course->title          = $request->title;
        $course->description    = $request->description;
        $course->thubnail       = $img_path;
        $course->old_price      = $request->old_price;
        $course->price          = $request->price;
        $course->save();

        return new CourseResource($course);
    }


    public function destroy(Course $course)
    {
        $course->delete();

        return new CourseResource($course);
    }


    public function validateModel()
    {
        return request()->validate([
            'user_id'       => 'required',
            'title'         => 'required',
        ]);
    }
}
