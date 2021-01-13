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

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($assignments) {
            $assignments->assignmentAttachments()->delete();
            $assignments->assignmentStatuses()->delete();
            $assignments->assignmentTimelines()->delete();
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
}
