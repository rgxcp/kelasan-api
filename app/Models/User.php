<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected $append = [
        'total_uncompleted_assignment',
        'total_doing_assignment',
        'total_completed_assignment'
    ];

    protected $appends = [
        'profile_picture'
    ];

    public function getTotalUncompletedAssignmentAttribute()
    {
        return AssignmentStatus::where([
            'user_id' => $this->id,
            'state' => 'UNCOMPLETED'
        ])->count();
    }

    public function getTotalDoingAssignmentAttribute()
    {
        return AssignmentStatus::where([
            'user_id' => $this->id,
            'state' => 'DOING'
        ])->count();
    }

    public function getTotalCompletedAssignmentAttribute()
    {
        return AssignmentStatus::where([
            'user_id' => $this->id,
            'state' => 'COMPLETED'
        ])->count();
    }

    public function getProfilePictureAttribute()
    {
        return 'https://ui-avatars.com/api/?name='
            . preg_replace('/\s+/', '+', $this->full_name)
            . '&size=512';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
