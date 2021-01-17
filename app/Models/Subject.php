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

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($subjects) {
            $subjects->assignments()->delete();
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
