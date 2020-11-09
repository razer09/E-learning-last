<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use App\Course;
use App\Http\Resources\Section as SectionResource;
use App\Http\Resources\Course as CourseResource;


class SectionController extends Controller
{
    public function index(Course $course)
    {
        $section = $course->sections()->latest()->get();
        return SectionResource::collection($section);
    }

    public function store(Request $request, Course $course)
    {
        $this->validateModel();

        $section                = new Section;
        $section->course_id     = $request->course_id;
        $section->name          = $request->name;
        $section->save();


        return new SectionResource($section);
    }


    public function show(Section $section)
    {
        return new SectionResource($section);
    }


    public function update(Request $request, Section $section)
    {
        $this->validateModel();

        $section->course_id     = $request->course_id;
        $section->name          = $request->name;
        $section->save();

        return new SectionResource($section);
    }


    public function destroy(Section $section)
    {
        $section->delete();

        return new SectionResource($section);
    }


    public function validateModel()
    {
        return request()->validate([
            'course_id'       => 'required',
            'name'         => 'required',
        ]);
    }
}
