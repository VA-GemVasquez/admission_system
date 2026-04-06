<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'years_old',
        'contact_number',
        'gmail_account',
        'temporary_address',
        'permanent_address',
        'guardian_name',
        'guardian_phone',
        'student_type',
        'campus',
        'college',
        'course',
        'status'
    ];

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . ($this->middlename ? $this->middlename . ' ' : '') . $this->lastname;
    }
}