# EmployeeHub - Mini Employee Management System

EmployeeHub is a modern and professional Laravel 12 based Employee Management System designed to simplify employee record management, department handling, and secure authentication with role-based access control.

The system provides a clean corporate dashboard experience with a responsive UI built using Bootstrap 5 and Laravel best practices. EmployeeHub helps administrators efficiently manage employees and departments while regular users can securely access employee information.

---

## Quick Setup

```bash
git clone https://github.com/subham-paul/EmployeeHub.git
cd employeehub

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate:fresh --seed

npm run dev
php artisan storage:link

php artisan serve