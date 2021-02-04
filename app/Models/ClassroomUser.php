<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassroomUser extends Model
{
    use HasFactory, SerializeDate;

    protected $fillable = [
        'classroom_id',
        'user_id',
        'role'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
