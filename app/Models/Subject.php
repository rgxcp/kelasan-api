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

    protected static function booted()
    {
        static::deleted(function ($subject) {
            $subject->assignments()->delete();
        });
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
