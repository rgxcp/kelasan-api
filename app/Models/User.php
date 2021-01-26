<?php

namespace App\Models;

use App\Http\Traits\SerializeDate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SerializeDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    protected $append = [
        'token'
    ];

    protected $appends = [
        'profile_picture'
    ];

    // Relationship
    public function assignmentStatuses()
    {
        return $this->hasMany(AssignmentStatus::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'class_members')->withPivot('role');
    }

    // Accessors
    public function getTokenAttribute()
    {
        return $this->createToken(request()->device ?? 'Unknown Device');
    }

    public function getProfilePictureAttribute()
    {
        return 'https://ui-avatars.com/api/?name='
            . preg_replace('/\s+/', '+', $this->full_name)
            . '&size=512';
    }

    // Mutator
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
