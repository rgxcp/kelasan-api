<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'created_by',
        'detail'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($notes) {
            $notes->noteAttachments()->delete();
            $notes->noteTimelines()->delete();
        });
    }

    public function noteAttachments()
    {
        return $this->hasMany(NoteAttachment::class);
    }

    public function noteTimelines()
    {
        return $this->hasMany(NoteTimeline::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
