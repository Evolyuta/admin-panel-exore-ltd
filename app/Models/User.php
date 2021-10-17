<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_manager',
        'manager_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relationship with posts
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(
            Post::class,
            'employee_id',
            'id'
        );
    }

    /**
     * Relationship with posts by related employee
     *
     * @return HasManyThrough
     */
    public function employeePosts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Post::class,
            User::class,
            'manager_id',
            'employee_id',
            'id',
            'id'
        );
    }
}
