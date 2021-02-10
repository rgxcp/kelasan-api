<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteImage extends Model
{
    use HasFactory, SerializeDate, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'note_id',
        'user_id',
        'image'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mutator
    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
