<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'created_by',
        'detail'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($note) {
            NoteTimeline::create([
                'classroom_id' => $note->classroom_id,
                'note_id' => $note->id,
                'user_id' => $note->created_by,
                'type' => 'CREATED'
            ]);
        });

        static::updated(function ($note) {
            NoteTimeline::create([
                'classroom_id' => $note->classroom_id,
                'note_id' => $note->id,
                'user_id' => request()->user()->id
            ]);
        });

        static::deleted(function ($note) {
            $note->noteAttachments()->delete();
            $note->noteTimelines()->delete();
        });
    }

    // Relationships
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function noteAttachments()
    {
        return $this->hasMany(NoteAttachment::class);
    }

    public function noteTimelines()
    {
        return $this->hasMany(NoteTimeline::class);
    }
}
