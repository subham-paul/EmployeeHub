@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Dashboard</h1>

    <!-- Dashboard Metrics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Employees</h5>
                            <p class="card-text fs-3">{{ $totalEmployees }}</p>
                        </div>
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Active Employees</h5>
                            <p class="card-text fs-3">{{ $activeEmployees }}</p>
                        </div>
                        <i class="bi bi-person-check-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Inactive Employees</h5>
                            <p class="card-text fs-3">{{ $inactiveEmployees }}</p>
                        </div>
                        <i class="bi bi-person-x-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Departments</h5>
                            <p class="card-text fs-3">{{ $departments->count() }}</p>
                        </div>
                        <i class="bi bi-building-fill fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Employees Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Recent Employees</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Status</th>
                            <th scope="col">Joining Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentEmployees as $employee)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ $employee->profile_photo ? asset('storage/' . $employee->profile_photo) : 'https://via.placeholder.com/40' }}" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit: cover;"></td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->department->name ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $employee->status == 'active' ? 'success' : 'warning' }}">{{ ucfirst($employee->status) }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No recent employees found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection