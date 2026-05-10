# EmployeeHub - Mini Employee Management System

EmployeeHub is a modern and professional Laravel 12 based Employee Management System designed to simplify employee record management, department handling, and secure authentication with role-based access control.

The system provides a clean corporate dashboard experience with a responsive UI built using Bootstrap 5 and Laravel best practices. EmployeeHub helps administrators efficiently manage employees and departments while regular users can securely access employee information.

---

# Features

## 1. Authentication System

Secure authentication system with a professional and responsive user interface.

### Includes:
- User Registration
- Secure Login
- Forgot Password
- Logout Functionality
- Password Hashing & Security
- Professional Authentication Pages
- Gradient-styled EmployeeHub branding

---

## 2. Role-Based Access Control (RBAC)

The system uses role-based access control to separate permissions between administrators and regular users.

### Admin Permissions
- Full Employee CRUD access
- Department management
- Excel export
- PDF export
- Dashboard access

### User Permissions
- View employee list
- View employee details only

### Implementation
- Custom `admin` middleware
- `isAdmin()` method on the `User` model

---

## 3. Employee CRUD Module

Complete employee management functionality.

### Features
- Add Employee
- View Employee
- Edit Employee
- Delete Employee
- Delete Confirmation Modal

---

## 4. Employee Data Management

The system manages the following employee fields:

| Field | Description |
|------|-------------|
| profile_photo | Employee profile image |
| name | Employee full name |
| email | Unique employee email |
| phone | Contact number |
| department_id | Assigned department |
| designation | Employee designation |
| salary | Employee salary |
| joining_date | Employee joining date |
| status | Active / Inactive |
| created_at | Record creation timestamp |
| updated_at | Record update timestamp |

---

## 5. Validation System

Robust form validation implemented using Laravel Form Requests.

### Validation Classes
- `StoreEmployeeRequest`
- `UpdateEmployeeRequest`

### Validation Features
- Required field validation
- Email uniqueness validation
- Image validation
- File type restrictions
- Update-safe unique email handling

---

## 6. Search & Filter

Advanced employee filtering system.

### Search By
- Employee Name
- Employee Email

### Filter By
- Department
- Status

---

## 7. Pagination

Efficient employee browsing with:
- 10 employees per page
- Clean pagination UI
- Optimized listing performance

---

## 8. Profile Image Upload

Employee profile photo upload system.

### Features
- Image upload support
- Default placeholder image
- Centered profile photo section in forms
- Secure file storage handling

---

## 9. Data Export

### Excel Export
Implemented using **Maatwebsite/Laravel-Excel**

#### Exported Columns
- Employee Name
- Email
- Phone
- Department
- Designation
- Salary
- Joining Date
- Status

### PDF Export
Implemented using **Barryvdh DomPDF**

#### Exported Columns
- Employee Name
- Email
- Phone
- Department
- Designation
- Salary
- Joining Date
- Status

### Additional Features
- Indian Rupee Symbol (`₹`) support for salary
- Professional export formatting
- Proper column headings

---

## 10. User Profile Management

Authenticated users can:
- View profile information
- Update profile details
- Change password securely

---

## 11. Department Management

Admin users can manage departments.

### Features
- Add Department
- View Department List

---

## 12. Professional UI

Modern corporate dashboard design using Bootstrap 5.

### UI Components
- Responsive Layout
- Cards
- Tables
- Forms
- Badges
- Alerts
- Modals
- Rounded Corners
- Box Shadows
- White / Light Theme

---

## 13. Flash Messages

User-friendly notification system using Bootstrap alerts.

### Includes
- Success Messages
- Error Messages
- Validation Alerts

---

## 14. Delete Confirmation

Secure delete confirmation modal for critical actions like:
- Employee deletion

---

## 15. Authentication Page Design

Professional authentication pages featuring:
- Gradient-styled EmployeeHub text
- Modern login/register forms
- Responsive layout
- No image-based logo dependency

---

## 16. Dashboard

Dynamic admin dashboard with real-time statistics.

### Dashboard Includes
- Total Employees Count
- Active Employees Count
- Inactive Employees Count
- Total Departments Count
- 5 Most Recent Employees
- Employees sorted in descending order

### Removed Section
- Employee Statistics section removed for cleaner UI

---

## 17. Sidebar Navigation

Sidebar contains:
- Dashboard
- Employees
- Departments (Admin Only)

### Removed Links
- Roles
- Settings

---

# Technical Stack

## Backend
- Laravel 12
- PHP ^8.2

## Database
- MySQL

## Frontend
- Blade Template Engine
- HTML5
- CSS3

## Styling
- Bootstrap 5
- Bootstrap Icons

## Packages
- Maatwebsite/Laravel-Excel
- barryvdh/laravel-dompdf

## Development Tools
- Composer
- Node.js
- npm / yarn

---

# Setup Instructions

Follow the steps below to set up the project on your local machine.

---

## 1. Prerequisites

Make sure the following software is installed:

- PHP ^8.2
- Composer
- Node.js & npm (or yarn)
- MySQL
- Git

---

## 2. Clone the Repository

```bash
git clone https://github.com/subham-paul/EmployeeHub.git
cd employeehub
````

---

## 3. Install PHP Dependencies

```bash
composer install
```

---

## 4. Environment Configuration

Copy the environment file:

```bash
cp .env.example .env
```

Open the `.env` file and configure your database credentials:

```env
DB_CONNECTION=mysql
DB_DATABASE=employee_management_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

Generate the application key:

```bash
php artisan key:generate
```

---

## 5. Database Setup

Create a new MySQL database named:

```text
employee_management_system
```

You can create it using phpMyAdmin, MySQL Workbench, or terminal.

---

## 6. Run Migrations and Seeders

Run the following command:

```bash
php artisan migrate:fresh --seed
```

This command will:

* Create all database tables
* Seed default data
* Automatically create the default admin user

---

## 7. Install Frontend Dependencies & Build Assets

Install Node.js dependencies:

```bash
npm install
```

Run the Vite development server:

```bash
npm run dev
```

For production build:

```bash
npm run build
```

---

## 8. Start the Development Server

Run the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

---

## 9. Create Storage Symlink

Run the following command:

```bash
php artisan storage:link
```

### Purpose

This command creates a symbolic link between the `storage` and `public` directories so uploaded employee profile photos can be publicly accessible in the browser.

---

# Admin Access

The database seeder automatically creates a default administrator account.

## Default Admin Credentials

| Email                                         | Password |
| --------------------------------------------- | -------- |
| [admin@example.com](mailto:admin@example.com) | password |

---


# License

The Laravel framework is open-sourced software licensed under the MIT License.



