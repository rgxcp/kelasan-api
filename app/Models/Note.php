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
        'user_id',
        'detail'
    ];

    // Events
    protected static function booted()
    {
        static::created(function ($note) {
            // Images
            if (request()->hasFile('images')) {
                $images = request()->images;
                foreach ($images as $image) {
                    $note->noteImages()->create([
                        'classroom_id' => $note->classroom_id,
                        'user_id' => $note->user_id,
                        'image' => $image->store('images')
                    ]);
                }
            }

            // Timelines
            $note->noteTimelines()->create([
                'classroom_id' => $note->classroom_id,
                'user_id' => $note->user_id,
                'type' => 'CREATED'
            ]);
        });

        static::updated(function ($note) {
            // Images
            if (request()->hasFile('images')) {
                $images = request()->images;
                foreach ($images as $image) {
                    $note->noteImages()->create([
                        'classroom_id' => $note->classroom_id,
                        'user_id' => request()->user()->id,
                        'image' => $image->store('images')
                    ]);
                }
            }

            // Timelines
            $note->noteTimelines()->create([
                'classroom_id' => $note->classroom_id,
                'user_id' => request()->user()->id
            ]);
        });

        static::deleted(function ($note) {
            $note->noteImages()->delete();
            $note->noteTimelines()->delete();
        });
    }

    // Relationships
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function noteImages()
    {
        return $this->hasMany(NoteImage::class);
    }

    public function noteTimelines()
    {
        return $this->hasMany(NoteTimeline::class);
    }
}
