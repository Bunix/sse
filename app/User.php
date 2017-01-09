<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const STUDENT = 's';
    const PROFESSOR = 'p';
    const EMPLOYEE = 'e';

    public static $roles = [
        self::STUDENT => 'Student',
        self::PROFESSOR => 'Professor',
        self::EMPLOYEE => 'Employee'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'street', 'housenumber', 'zipcode', 'city', 'phone', 'birthdate', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isStudent()
    {
        return $this->role == self::STUDENT;
    }

    public function isProfessor()
    {
        return $this->role == self::PROFESSOR;
    }

    public function isEmployee()
    {
        return $this->role == self::EMPLOYEE;
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course')->withPivot('grade');
    }
}
