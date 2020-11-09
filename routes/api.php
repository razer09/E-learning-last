<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Auth in backend

});

    Route::apiResources([
        'tags'      => 'Api\TagController',
        'courses'   => 'Api\CourseController',
        'users'     => 'Api\UserController'
    ]);

    // My courses enrolledCourses
    Route::get('createdCourses/{user}', 'Api\UserController@createdCourses');

    // Enrolled Courses
    Route::get('enrolledCourses/{user}', 'Api\UserController@enrolledCourses');

    Route::get('enrollCourse/{user}/{course}', 'Api\UserController@enrollCourse');
    Route::get('cancelCourse/{user}/{course}', 'Api\UserController@cancelCourse');

    // Abilities
    Route::get('abilities/{user}', 'Api\UserController@abilities');


    // Tags of user
    Route::get('tagsUser/{user}', 'Api\TagController@tags');

    // Recomendation of user
    Route::post('recomended', 'Api\TagController@recomended');

    // Sections
    Route::apiResource('courses.sections', 'Api\SectionController')->shallow();

    // Video
    Route::apiResource('sections.videos', 'Api\VideoController')->shallow();

    //complete video
    Route::post('completeVideo', 'Api\completionController@complete');
    Route::post('incompleteVideo', 'Api\completionController@incomplete');
    // Nbr completed
    Route::get('progressCourse/{user}', 'Api\VideoController@progressCourse');

    // Reviews
    Route::get('Reviews/{course}', 'Api\reviewsController@index');
    Route::post('Reviews', 'Api\reviewsController@store');
    Route::put('Reviews', 'Api\reviewsController@update');
    Route::delete('Reviews/{user}/{course}', 'Api\reviewsController@delete');

