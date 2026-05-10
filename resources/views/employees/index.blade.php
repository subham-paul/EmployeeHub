@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Employee List</h1>
        @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add Employee
        </a>
        @endif
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Filter & Search</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('employees.index') }}" method="GET">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by name, email, or phone" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="department" class="form-select">
                            <option value="">All Departments</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="bi bi-funnel me-2"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Employee Records</h5>
            @if(Auth::check() && Auth::user()->isAdmin())
            <div>
                <a href="{{ route('employees.export', ['type' => 'excel', 'search' => request('search'), 'department' => request('department'), 'status' => request('status')]) }}" class="btn btn-success me-2"><i class="bi bi-file-earmark-excel me-2"></i>Export Excel</a>
                <a href="{{ route('employees.export', ['type' => 'pdf', 'search' => request('search'), 'department' => request('department'), 'status' => request('status')]) }}" class="btn btn-danger"><i class="bi bi-file-earmark-pdf me-2"></i>Export PDF</a>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Department</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Joining Date</th>
                            <th scope="col">Status</th>
                            @if(Auth::check() && Auth::user()->isAdmin())
                            <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td><img src="{{ $employee->profile_photo ? asset('storage/' . $employee->profile_photo) : 'https://via.placeholder.com/40' }}" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit: cover;"></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->department->name ?? 'N/A' }}</td>
                            <td>{{ $employee->designation }}</td>
                            <td>₹{{ number_format($employee->salary, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') }}</td>
                            <td>
                                @if($employee->status == 'active')
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-warning">Inactive</span>
                                @endif
                            </td>
                            @if(Auth::check() && Auth::user()->isAdmin())
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning text-white" title="Edit"><i class="bi bi-pencil"></i></a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" data-id="{{ $employee->id }}" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                            @else
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info text-white" title="View"><i class="bi bi-eye"></i></a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::check() && Auth::user()->isAdmin() ? '10' : '9' }}" class="text-center">No employees found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
@if(Auth::check() && Auth::user()->isAdmin())
<div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEmployeeModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this employee record? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteEmployeeForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteEmployeeModal = document.getElementById('deleteEmployeeModal');
        deleteEmployeeModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var employeeId = button.getAttribute('data-id'); // Extract info from data-* attributes
            var form = deleteEmployeeModal.querySelector('#deleteEmployeeForm');
            form.action = '/employees/' + employeeId; // Set the form action dynamically
        });
    });
</script>
@endif
@endsection