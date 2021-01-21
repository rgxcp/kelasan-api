<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'subject_id',
        'created_by',
        'detail',
        'type',
        'start',
        'deadline'
    ];

    protected static function booted()
    {
        static::created(function ($assignment) {
            AssignmentTimeline::create([
                'classroom_id' => $assignment->classroom_id,
                'assignment_id' => $assignment->id,
                'user_id' => $assignment->created_by,
                'type' => 'CREATED'
            ]);
        });

        static::deleted(function ($assignment) {
            $assignment->assignmentAttachments()->delete();
            $assignment->assignmentStatuses()->delete();
            $assignment->assignmentTimelines()->delete();
        });
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
