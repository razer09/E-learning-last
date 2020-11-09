<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Tag;
use App\User;
use App\Course;
use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\Courses as CoursesResource;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(6);

        return TagResource::collection($tags);
    }


    public function store(Request $request)
    {
        $this->validateTags();

        $tag        = new Tag;
        $tag->name  = $request->name;
        $tag->label = $request->label;
        $tag->save();


        return new TagResource($tag);
    }


    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        return new TagResource($tag);
    }

   public function update(Request $request, $id)
    {
        $this->validateTags();

        $tag = Tag::findOrFail($id);
        $tag->name  = $request->name;
        $tag->label = $request->label;
        $tag->save();

        return new TagResource($tag);
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->delete();

        return new TagResource($tag);
    }


    public function validateTags()
    {
        return request()->validate([
            'name' => 'required',
            'label' => 'required'
        ]);
    }

    public function tags(User $user)
    {
        return $user->tags()->pluck('id');
    }

    public function recomended(Request $request)
    {
        if($request->has('tags')){
            $courses =  DB::table('courses')
                    ->leftJoin('enrolled_course', 'enrolled_course.course_id', '=', 'courses.id')
                    ->leftJoin('course_tag', 'course_tag.course_id', '=', 'courses.id')
                    ->whereIn('course_tag.tag_id', $request->tags)
                    ->where('enrolled_course.user_id', '=', $request->user_id)
                    ->take(3)
                    ->get();

            if( $courses->count() < 3){
                $courses = Course::latest()->take(3)->get();
                return CoursesResource::collection($courses);
            }
            return CoursesResource::collection($courses);


        }else{
            $courses = Course::latest()->take(3)->get();
            return CoursesResource::collection($courses);
        }
    }
}
