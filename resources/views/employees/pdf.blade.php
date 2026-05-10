<!DOCTYPE html>
<html>
<head>
    <title>Employee List PDF</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <h1>Employee List</h1>

    <table>
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Salary</th>
                <th>Joining Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employeesToExport as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->department->name ?? 'N/A' }}</td>
                    <td>{{ $employee->designation }}</td>
                    <td>{{ number_format($employee->salary, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($employee->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
