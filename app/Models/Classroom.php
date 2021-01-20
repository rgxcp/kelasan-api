<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'leader',
        'name',
        'invitation_code'
    ];

    protected $hidden = [
        'invitation_code'
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
}
