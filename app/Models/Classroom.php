<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory, SerializeDate;

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
            ClassroomUser::create([
                'classroom_id' => $classroom->id,
                'user_id' => $classroom->user_id,
                'role' => 'LEADER'
            ]);
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

    public function classroomUsers()
    {
        return $this->hasMany(ClassroomUser::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
