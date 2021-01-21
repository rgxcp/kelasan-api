<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'created_by',
        'name'
    ];

    protected $append = [
        'total_assignment'
    ];

    protected static function booted()
    {
        static::deleted(function ($subject) {
            $subject->assignments()->delete();
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function getTotalAssignmentAttribute()
    {
        return Assignment::where([
            'classroom_id' => $this->classroom_id,
            'subject_id' => $this->id
        ])->count();
    }
}
