<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
