<?php

use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\AssignmentStatusController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\SubjectController;
use App\Http\Controllers\API\UserController;
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

// Version 1
Route::middleware('json.header')->prefix('v1')->group(function () {
    // Classroom
    Route::middleware('auth:sanctum')->prefix('classrooms')->group(function () {
        Route::post('', [ClassroomController::class, 'store']);
        Route::post('join', [ClassroomController::class, 'join']);
        Route::middleware('classroom.user')->prefix('{classroom}')->group(function () {
            Route::get('', [ClassroomController::class, 'show']);
            Route::get('invitation-code', [ClassroomController::class, 'invitationCode']);
            Route::get('assignments', [ClassroomController::class, 'assignments']);
            Route::get('notes', [ClassroomController::class, 'notes']);
            Route::get('subjects', [ClassroomController::class, 'subjects']);
            Route::get('users', [ClassroomController::class, 'users']);
            Route::put('', [ClassroomController::class, 'update']);
            Route::middleware('classroom.leader')->delete('', [ClassroomController::class, 'destroy']);

            // Assignment
            Route::prefix('assignments')->group(function () {
                Route::post('', [AssignmentController::class, 'store']);
                Route::middleware('belong.to.class')->prefix('{assignment}')->group(function () {
                    Route::get('', [AssignmentController::class, 'show']);
                    Route::get('statuses', [AssignmentController::class, 'statuses']);
                    Route::get('timelines', [AssignmentController::class, 'timelines']);
                    Route::put('', [AssignmentController::class, 'update']);
                    Route::put('change-status', AssignmentStatusController::class);
                    Route::middleware('classroom.leader')->delete('', [AssignmentController::class, 'destroy']);
                });
            });

            // Note
            Route::prefix('notes')->group(function () {
                Route::post('', [NoteController::class, 'store']);
                Route::middleware('belong.to.class')->prefix('{note}')->group(function () {
                    Route::get('', [NoteController::class, 'show']);
                    Route::get('timelines', [NoteController::class, 'timelines']);
                    Route::put('', [NoteController::class, 'update']);
                    Route::middleware('classroom.leader')->delete('', [NoteController::class, 'destroy']);
                });
            });

            // Subject
            Route::prefix('subjects')->group(function () {
                Route::post('', [SubjectController::class, 'store']);
                Route::middleware('belong.to.class')->prefix('{subject}')->group(function () {
                    Route::get('', [SubjectController::class, 'show']);
                    Route::get('assignments', [SubjectController::class, 'assignments']);
                    Route::put('', [SubjectController::class, 'update']);
                    Route::middleware('classroom.leader')->delete('', [SubjectController::class, 'destroy']);
                });
            });
        });
    });

    // User
    Route::prefix('users')->group(function () {
        Route::post('sign-up', [UserController::class, 'signUp']);
        Route::post('sign-in', [UserController::class, 'signIn']);
        Route::middleware('auth:sanctum')->prefix('self')->group(function () {
            Route::get('', [UserController::class, 'show']);
            Route::get('assignments', [UserController::class, 'assignments']);
            Route::get('classrooms', [UserController::class, 'classrooms']);
            Route::get('notes', [UserController::class, 'notes']);
            Route::get('subjects', [UserController::class, 'subjects']);
            Route::put('', [UserController::class, 'update']);
            Route::put('change-password', [UserController::class, 'changePassword']);
            Route::delete('sign-out', [UserController::class, 'signOut']);
            Route::delete('sign-out-all', [UserController::class, 'signOutAll']);
        });
    });
});
