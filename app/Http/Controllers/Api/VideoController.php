<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Section;
use App\Video;
use App\User;
use App\Course;
use App\Http\Resources\Video as VideoResource;
use App\Http\Resources\Section as SectionResource;


class VideoController extends Controller
{
    public function index(Section $section)
    {
        $videos = $section->videos()->latest()->get();
        return new VideoResource($videos);
    }

    public function store(Request $request, Section $section)
    {
        $this->validateModel();


        $course_id = $section->course_id;
        $sect_id = $section->id;
        $fileNamePath = 'public/courses/'.$course_id.'/videos/'.$sect_id;

        $video_path = '/storage/courses/default_image.mp4';

        if ($request->hasFile('url')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('url')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('url')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('url')->storeAs($fileNamePath, $fileNameToStore);

            $video_path = '/storage/courses/'.$course_id.'/videos/'.$sect_id.'/'.$fileNameToStore;

        }

        $video                 = new Video;
        $video->section_id     = $request->section_id;
        $video->name           = $request->name;
        $video->url            = $video_path;
        $video->save();

        return new VideoResource($video);
    }

    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function update(Request $request, Video $video)
    {
        $this->validateModel();
        $section = Section::find($video->section_id);
        $sect_id = $section->id;
        $course_id = $section->course_id;

        $fileNamePath = 'public/courses/'.$course_id.'/videos/'.$sect_id;

        $video_path = '/storage/courses/default_video.mp4';

        if ($request->hasFile('url')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('url')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('url')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('url')->storeAs($fileNamePath, $fileNameToStore);

            $video_path = '/storage/courses/'.$course_id.'/videos/'.$sect_id.'/'.$fileNameToStore;
            // Delete file if exists
            Storage::delete($fileNamePath.'/'.$fileNameToStore);
        }

        $video->section_id     = $request->section_id;
        $video->name           = $request->name;
        $video->url            = $video_path;
        $video->save();

        return new VideoResource($video);
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return new VideoResource($video);
    }

    public function validateModel()
    {
        return request()->validate([
            'section_id'   => 'required',
            'name'         => 'required',
            'url'          => 'required'
        ]);
    }

    public function progressCourse(User $user)
    {
        // get All Enrolled courses
        $enrolled_course = $user->enrolledCourses;
        $progress = [];
        // foreach course get nbr_completed + nbr_videos
        foreach ($enrolled_course as $course) {
            $nbr_lessons   = $course->videos()->count();
            $videos = $course->videos->pluck('id');
            $nbr_completed = \DB::table('completions')
                ->where('user_id', '=', $user->id)
                ->whereIn('video_id', $videos)
                ->count();
            // Set progress
            $resultat = $nbr_lessons == 0 ? 0 : ($nbr_completed * 100 )/ $nbr_lessons;
            $progress[$course->id] = $resultat;
        }

        return $progress;
    }
}
