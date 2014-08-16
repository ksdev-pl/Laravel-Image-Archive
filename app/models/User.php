<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /** @type array $rules  Validation rules */
    public static $rules = [
        'email' => 'sometimes|required|email|unique:users',
        'password' => 'required|min:4',
        'role' => 'required|integer'
    ];

    /** @type array $fillable  Fillable attributes */
    protected $fillable = ['email', 'password', 'role'];

    /** @type array $hidden  Attributes excluded from the model's array or JSON */
    protected $hidden = ['password', 'remember_token'];

    /** Numeric equivalent of user roles */
    const ADMIN = 1, NORMAL = 2, RESTRICTED = 3;

    /**
     * Setter for the password attribute
     *
     * Hashes the user password
     *
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
