<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_photo',
        'name',
        'email',
        'phone',
        'department_id', // This is the foreign key
        'designation',
        'salary',
        'joining_date',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
