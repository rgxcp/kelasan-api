<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory, SerializeDate;

    protected $fillable = [
        'leader',
        'name',
        'invitation_code'
    ];

    protected $hidden = [
        'invitation_code'
    ];

    protected $append = [
        'total_assignment',
        'total_class_member',
        'total_note',
        'total_subject'
    ];

    protected static function booted()
    {
        static::created(function ($classroom) {
            ClassMember::create([
                'classroom_id' => $classroom->id,
                'user_id' => $classroom->leader,
                'role' => 'LEADER'
            ]);
        });
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function classMembers()
    {
        return $this->hasMany(ClassMember::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function getTotalAssignmentAttribute()
    {
        return Assignment::where('classroom_id', $this->id)->count();
    }

    public function getTotalClassMemberAttribute()
    {
        return ClassMember::where('classroom_id', $this->id)->count();
    }

    public function getTotalNoteAttribute()
    {
        return Note::where('classroom_id', $this->id)->count();
    }

    public function getTotalSubjectAttribute()
    {
        return Subject::where('classroom_id', $this->id)->count();
    }
}
