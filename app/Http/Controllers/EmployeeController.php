<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EmployeesExport;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        // Search by Name or Email
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        // Filter by Department
        if ($request->department) {
            $query->where('department_id', $request->department);
        }

        // Filter by Status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Pagination
        $employees = $query->paginate(10);

        // Get all departments
        $departments = Department::all();

        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->department_id = $request->department_id;
        $employee->designation = $request->designation;
        $employee->salary = $request->salary;
        $employee->joining_date = $request->joining_date;
        $employee->status = $request->status;

        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')
                ->store('uploads/employees', 'public');
            $employee->profile_photo = $imagePath;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // Get validated data from the request
        $validatedData = $request->validated();

        // Update employee fields
        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
        $employee->phone = $validatedData['phone'];
        $employee->department_id = $validatedData['department_id'];
        $employee->designation = $validatedData['designation'];
        $employee->salary = $validatedData['salary'];
        $employee->joining_date = $validatedData['joining_date'];
        $employee->status = $validatedData['status'];

        // Handle profile photo update
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            // Store new photo
            $imagePath = $request->file('profile_photo')->store('uploads/employees', 'public');
            $employee->profile_photo = $imagePath;
        } elseif ($request->boolean('remove_profile_photo')) { // Assuming a checkbox to remove photo
            if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            $employee->profile_photo = null;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
            Storage::disk('public')->delete($employee->profile_photo);
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }

    public function export(Request $request, $type)
    {
        $query = Employee::query();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        if ($request->department) {
            $query->where('department_id', $request->department);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $employeesToExport = $query->get();

        if ($type === 'excel') {
            return Excel::download(new EmployeesExport($employeesToExport), 'employees.xlsx');
        } elseif ($type === 'pdf') {
            $pdf = Pdf::loadView('employees.pdf', compact('employeesToExport'));
            return $pdf->download('employees.pdf');
        }

        return redirect()->back()->with('error', 'Invalid export type.');
    }
}
