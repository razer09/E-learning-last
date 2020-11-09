<?php

namespace App\Http\Controllers\api;
use App\Video;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class completionController extends Controller
{
    public function complete(Request $request)
    {
        $video = Video::findOrFail($request->video);
        $user = User::findOrFail($request->user);
        $user->complete($video);
    }

    public function incomplete(Request $request)
    {
        $video = Video::findOrFail($request->video);
        $user = User::findOrFail($request->user);
        $user->incomplete($video);
    }
}
