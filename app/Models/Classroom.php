<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'invitation_code'
    ];

    protected $hidden = [
        'invitation_code'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($classroom) {
            $classroom->classroomUsers()->create([
                'user_id' => $classroom->user_id,
                'role' => 'LEADER'
            ]);
        });

        static::deleted(function ($classroom) {
            $classroom->assignments()->delete();
            $classroom->assignmentImages()->delete();
            $classroom->assignmentStatuses()->delete();
            $classroom->assignmentTimelines()->delete();
            $classroom->classroomUsers()->delete();
            $classroom->notes()->delete();
            $classroom->noteImages()->delete();
            $classroom->noteTimelines()->delete();
            $classroom->subjects()->delete();
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
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

    public function classroomUsers()
    {
        return $this->hasMany(ClassroomUser::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function noteImages()
    {
        return $this->hasMany(NoteImage::class);
    }

    public function noteTimelines()
    {
        return $this->hasMany(NoteTimeline::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }
}
