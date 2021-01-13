<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'assignment_id',
        'user_id',
        'type'
    ];
}
