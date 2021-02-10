<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'name'
    ];

    // Events
    protected static function booted()
    {
        static::deleted(function ($subject) {
            $subject->assignments()->delete();
            $subject->assignmentImages()->delete();
            $subject->assignmentStatuses()->delete();
            $subject->assignmentTimelines()->delete();
        });
    }

    // Relationships
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

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
}
