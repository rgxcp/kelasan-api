<?php

use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\NoteTimelineController;
use App\Http\Controllers\API\SearchController;
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
Route::middleware('json')->prefix('v1')->group(function () {
    // Classroom
    Route::middleware('auth:sanctum')->prefix('classrooms')->group(function () {
        Route::post('', [ClassroomController::class, 'create']);
        Route::post('join', [ClassroomController::class, 'join']);
        Route::middleware('member')->prefix('{classroom}')->group(function () {
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
                Route::middleware('owner')->prefix('{assignment}')->group(function () {
                    Route::get('', [AssignmentController::class, 'detail']);
                    Route::get('status', [AssignmentController::class, 'status']);
                    Route::get('timeline', [AssignmentController::class, 'timeline']);
                    Route::put('', [AssignmentController::class, 'update']);
                    Route::put('change-status', [AssignmentController::class, 'changeStatus']);
                    Route::middleware('leader')->delete('', [AssignmentController::class, 'delete']);
                });
            });

            // Note & Note Timeline
            Route::prefix('notes')->group(function () {
                Route::post('', [NoteController::class, 'create']);
                Route::middleware('owner')->prefix('{note}')->group(function () {
                    Route::get('', [NoteController::class, 'detail']);
                    Route::get('timeline', NoteTimelineController::class);
                    Route::put('', [NoteController::class, 'update']);
                    Route::middleware('leader')->delete('', [NoteController::class, 'delete']);
                });
            });

            // Subject
            Route::prefix('subjects')->group(function () {
                Route::post('', [SubjectController::class, 'create']);
                Route::middleware('owner')->prefix('{subject}')->group(function () {
                    Route::get('', [SubjectController::class, 'detail']);
                    Route::get('assignments', [SubjectController::class, 'assignments']);
                    Route::put('', [SubjectController::class, 'rename']);
                    Route::middleware('leader')->delete('', [SubjectController::class, 'delete']);
                });
            });
        });
    });

    // Search
    Route::middleware('auth:sanctum')->get('search', [SearchController::class, 'search']);

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
