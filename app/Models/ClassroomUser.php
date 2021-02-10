<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassroomUser extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $table = 'classroom_user';

    protected $fillable = [
        'classroom_id',
        'user_id',
        'role'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($classroomUser) {
            $assignments = Assignment::where('classroom_id', $classroomUser->classroom_id)->get(['id', 'subject_id']);
            foreach ($assignments as $assignment) {
                $assignment->assignmentStatuses()->create([
                    'classroom_id' => $classroomUser->classroom_id,
                    'subject_id' => $assignment->subject_id,
                    'user_id' => $classroomUser->user_id
                ]);
            }
        });
    }
}
