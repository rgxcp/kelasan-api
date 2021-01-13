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
}
