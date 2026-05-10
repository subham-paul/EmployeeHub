<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department; // Import the Department model

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create(['name' => 'Human Resources']);
        Department::create(['name' => 'Information Technology']);
        Department::create(['name' => 'Sales']);
        Department::create(['name' => 'Marketing']);
        Department::create(['name' => 'Finance']);
        // Add more departments as needed
    }
}
