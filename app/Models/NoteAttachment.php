<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoteAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'classroom_id',
        'note_id',
        'uploaded_by',
        'direct_link'
    ];

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
