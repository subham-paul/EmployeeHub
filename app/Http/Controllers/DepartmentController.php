<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest; // We will create this next

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // All methods in this controller require admin access
    }

    /**
     * Display a listing of the resource and the form to create a new one.
     */
    public function index()
    {
        $departments = Department::orderBy('name')->get();
        return view('departments.index', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    // You can add edit, update, destroy methods later if needed
}
