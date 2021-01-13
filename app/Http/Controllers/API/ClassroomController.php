<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    public function join()
    {
    }

    public function detail(Classroom $classroom)
    {
    }

    public function invitationCode()
    {
    }

    public function assignments()
    {
    }

    public function members()
    {
    }

    public function notes()
    {
    }

    public function subjects()
    {
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Failed',
                'reasons' => $validator->errors()
            ]);
        }

        $randomString = bin2hex(random_bytes(5));
        $invitationCode = substr($randomString, 0, 3)
            . '-'
            . substr($randomString, 3, 4)
            . '-'
            . substr($randomString, 7, 3);

        $classroom = Classroom::create([
            'leader' => $request->user()->id,
            'name' => $request->name,
            'invitation_code' => $invitationCode
        ])->makeVisible('invitation_code');

        return response()->json([
            'status' => 'Success',
            'result' => $classroom
        ]);
    }

    public function rename(Request $request, Classroom $classroom)
    {
    }
}
