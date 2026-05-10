@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Employee Details</h1>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to List
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Employee Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ $employee->profile_photo ? asset('storage/' . $employee->profile_photo) : 'https://via.placeholder.com/150' }}" alt="Profile Photo" class="img-thumbnail rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4>{{ $employee->name }}</h4>
                    <p class="text-muted">{{ $employee->designation }}</p>
                    @if($employee->status == 'active')
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-warning">Inactive</span>
                    @endif
                </div>
                <div class="col-md-8">
                    <h5 class="mb-3">Personal Details</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Email:</strong> {{ $employee->email }}</li>
                        <li class="list-group-item"><strong>Phone:</strong> {{ $employee->phone }}</li>
                        <li class="list-group-item"><strong>Department:</strong> {{ $employee->department->name ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Salary:</strong> ₹{{ number_format($employee->salary, 2) }}</li>
                        <li class="list-group-item"><strong>Joining Date:</strong> {{ \Carbon\Carbon::parse($employee->joining_date)->format('M d, Y') }}</li>
                    </ul>

                    <div class="d-flex">
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil me-2"></i>Edit Employee
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal" data-id="{{ $employee->id }}">
                            <i class="bi bi-trash me-2"></i>Delete Employee
                        </button>
                        @endif
                    </div>
                </div>
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