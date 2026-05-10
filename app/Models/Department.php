<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Add 'name' to the fillable array
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
