<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'subject_id',
        'user_id',
        'detail',
        'type',
        'start',
        'deadline'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($assignment) {
            AssignmentTimeline::create([
                'classroom_id' => $assignment->classroom_id,
                'assignment_id' => $assignment->id,
                'user_id' => $assignment->user_id,
                'type' => 'CREATED'
            ]);
        });

        static::updated(function ($assignment) {
            AssignmentTimeline::create([
                'classroom_id' => $assignment->classroom_id,
                'assignment_id' => $assignment->id,
                'user_id' => request()->user()->id
            ]);
        });

        static::deleted(function ($assignment) {
            $assignment->assignmentAttachments()->delete();
            $assignment->assignmentStatuses()->delete();
            $assignment->assignmentTimelines()->delete();
        });
    }

    // Relationships
    public function assignmentStatus()
    {
        return $this->hasOne(AssignmentStatus::class)->withDefault([
            'state' => 'UNCOMPLETED'
        ]);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignmentAttachments()
    {
        return $this->hasMany(AssignmentAttachment::class);
    }

    public function assignmentStatuses()
    {
        return $this->hasMany(AssignmentStatus::class);
    }

    public function assignmentTimelines()
    {
        return $this->hasMany(AssignmentTimeline::class);
    }
}
