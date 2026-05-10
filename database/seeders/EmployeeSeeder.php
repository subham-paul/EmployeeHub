<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee; // Import the Employee model
use App\Models\Department; // Import the Department model
use Carbon\Carbon; // For dates

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some department IDs
        $hrDepartment = Department::where('name', 'Human Resources')->first();
        $itDepartment = Department::where('name', 'Information Technology')->first();
        $salesDepartment = Department::where('name', 'Sales')->first();

        // Create dummy employees
        if ($hrDepartment) {
            Employee::create([
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'phone' => '111-222-3333',
                'department_id' => $hrDepartment->id,
                'designation' => 'HR Manager',
                'salary' => 75000.00,
                'joining_date' => Carbon::parse('2020-01-15'),
                'status' => 'active',
                'profile_photo' => null, // Or a path to a dummy image
            ]);
        }

        if ($itDepartment) {
            Employee::create([
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '444-555-6666',
                'department_id' => $itDepartment->id,
                'designation' => 'Software Engineer',
                'salary' => 85000.00,
                'joining_date' => Carbon::parse('2021-03-20'),
                'status' => 'active',
                'profile_photo' => null,
            ]);
        }

        if ($salesDepartment) {
            Employee::create([
                'name' => 'Alice Johnson',
                'email' => 'alice.j@example.com',
                'phone' => '777-888-9999',
                'department_id' => $salesDepartment->id,
                'designation' => 'Sales Representative',
                'salary' => 60000.00,
                'joining_date' => Carbon::parse('2022-07-01'),
                'status' => 'inactive',
                'profile_photo' => null,
            ]);
        }
        // Add more employees as needed
    }
}
