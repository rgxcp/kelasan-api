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
        'created_by',
        'name'
    ];

    // Events
    protected static function booted()
    {
        static::deleted(function ($subject) {
            $subject->assignments()->delete();
        });
    }

    // Relationships
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
