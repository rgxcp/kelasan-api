<?php

use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\UserController;
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

Route::prefix('v1')->group(function () {
    // Classroom
    Route::middleware('auth:sanctum')->prefix('classrooms')->group(function () {
        Route::post('', [ClassroomController::class, 'create']);
        Route::middleware('notClassroomMember')->post('join', [ClassroomController::class, 'join']);
        Route::prefix('{classroom_id}')->group(function () {
            Route::get('', [ClassroomController::class, 'detail']);
            Route::get('invitation-code', [ClassroomController::class, 'invitationCode']);
            Route::get('assignments', [ClassroomController::class, 'assignments']);
            Route::get('members', [ClassroomController::class, 'members']);
            Route::get('notes', [ClassroomController::class, 'notes']);
            Route::get('subjects', [ClassroomController::class, 'subjects']);
            Route::put('', [ClassroomController::class, 'rename']);

            // Assignment
            Route::prefix('assignments')->group(function () {
                Route::post('', [AssignmentController::class, 'create']);
                Route::prefix('{assignment_id}')->group(function () {
                    Route::get('', [AssignmentController::class, 'detail']);
                    Route::get('status', [AssignmentController::class, 'status']);
                    Route::get('timeline', [AssignmentController::class, 'timeline']);
                    Route::put('', [AssignmentController::class, 'update']);
                    Route::put('change-status', [AssignmentController::class, 'changeStatus']);
                    Route::delete('', [AssignmentController::class, 'delete']);
                });
            });

            // Note
            Route::prefix('notes')->group(function () {
                Route::post('', [NoteController::class, 'create']);
                Route::prefix('{note_id}')->group(function () {
                    Route::get('', [NoteController::class, 'detail']);
                    Route::get('timeline', [NoteController::class, 'timeline']);
                    Route::put('', [NoteController::class, 'update']);
                    Route::delete('', [NoteController::class, 'delete']);
                });
            });

            // Subject
            Route::prefix('subjects')->group(function () {
                Route::post('', [SubjectController::class, 'create']);
                Route::prefix('{subject_id}')->group(function () {
                    Route::get('', [SubjectController::class, 'detail']);
                    Route::get('assignments', [SubjectController::class, 'assignments']);
                    Route::put('', [SubjectController::class, 'rename']);
                    Route::delete('', [SubjectController::class, 'delete']);
                });
            });
        });
    });

    // Search
    Route::get('search', [SearchController::class, 'search']);

    // User
    Route::prefix('users')->group(function () {
        Route::post('sign-up', [UserController::class, 'signUp']);
        Route::post('sign-in', [UserController::class, 'signIn']);
        Route::middleware('auth:sanctum')->prefix('self')->group(function () {
            Route::get('', [UserController::class, 'detail']);
            Route::get('assignments', [UserController::class, 'assignments']);
            Route::get('classrooms', [UserController::class, 'classrooms']);
            Route::get('subjects', [UserController::class, 'subjects']);
            Route::put('', [UserController::class, 'update']);
            Route::put('change-password', [UserController::class, 'changePassword']);
            Route::delete('sign-out', [UserController::class, 'signOut']);
            Route::delete('sign-out-all', [UserController::class, 'signOutAll']);
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
