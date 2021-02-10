<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Carbon\Carbon;
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

    protected $appends = [
        'start_timestamp',
        'deadline_timestamp'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($assignment) {
            // Images
            if (request()->hasFile('images')) {
                $images = request()->images;
                foreach ($images as $image) {
                    $assignment->assignmentImages()->create([
                        'classroom_id' => $assignment->classroom_id,
                        'subject_id' => $assignment->subject_id,
                        'user_id' => $assignment->user_id,
                        'image' => $image->store('images')
                    ]);
                }
            }

            // Statuses
            $classroomUsers = ClassroomUser::where('classroom_id', $assignment->classroom_id)->get('user_id');
            foreach ($classroomUsers as $classroomUser) {
                $assignment->assignmentStatuses()->create([
                    'classroom_id' => $assignment->classroom_id,
                    'subject_id' => $assignment->subject_id,
                    'user_id' => $classroomUser->user_id
                ]);
            }

            // Timelines
            $assignment->assignmentTimelines()->create([
                'classroom_id' => $assignment->classroom_id,
                'subject_id' => $assignment->subject_id,
                'user_id' => $assignment->user_id,
                'type' => 'CREATED'
            ]);
        });

        static::updated(function ($assignment) {
            // Images
            if (request()->hasFile('images')) {
                $images = request()->images;
                foreach ($images as $image) {
                    $assignment->assignmentImages()->create([
                        'classroom_id' => $assignment->classroom_id,
                        'subject_id' => $assignment->subject_id,
                        'user_id' => request()->user()->id,
                        'image' => $image->store('images')
                    ]);
                }
            }

            // Timelines
            $assignment->assignmentTimelines()->create([
                'classroom_id' => $assignment->classroom_id,
                'subject_id' => $assignment->subject_id,
                'user_id' => request()->user()->id
            ]);
        });

        static::deleted(function ($assignment) {
            $assignment->assignmentImages()->delete();
            $assignment->assignmentStatuses()->delete();
            $assignment->assignmentTimelines()->delete();
        });
    }

    // Relationships
    public function assignmentStatus()
    {
        return $this->hasOne(AssignmentStatus::class)->where('user_id', request()->user()->id);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignmentImages()
    {
        return $this->hasMany(AssignmentImage::class);
    }

    public function assignmentStatuses()
    {
        return $this->hasMany(AssignmentStatus::class);
    }

    public function assignmentTimelines()
    {
        return $this->hasMany(AssignmentTimeline::class);
    }

    // Accessors
    public function getStartTimestampAttribute()
    {
        return $this->start
            ? Carbon::parse($this->start)->diffForHumans()
            : null;
    }

    public function getDeadlineTimestampAttribute()
    {
        return $this->deadline
            ? Carbon::parse($this->deadline)->diffForHumans()
            : null;
    }
}
