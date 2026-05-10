<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Collection; // Import Collection
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Import WithHeadings
use Maatwebsite\Excel\Concerns\WithMapping; // Import WithMapping

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $employees;

    public function __construct(Collection $employees)
    {
        $this->employees = $employees;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->employees;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Employee Name',
            'Email',
            'Phone',
            'Department',
            'Designation',
            'Salary',
            'Joining Date',
            'Status',
        ];
    }

    /**
     * @param Employee $employee
     * @return array
     */
    public function map($employee): array
    {
        return [
            $employee->name,
            $employee->email,
            $employee->phone,
            $employee->department->name ?? 'N/A', // Assuming department relationship
            $employee->designation,
            '₹' . number_format($employee->salary, 2), // Indian Rupee symbol
            \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d'),
            ucfirst($employee->status),
        ];
    }
}
