<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExtDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'projects',
        'skills',
        'experience',
        'education',
        'certifications',
        'languages',
        'hobbies',
        'address',
        'city',
        'state',
        'country',
        'pincode',
        'linkedin',
        'facebook',
        'twitter',
        'instagram',
        'github',
        'website',
        'team',
        'role',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
