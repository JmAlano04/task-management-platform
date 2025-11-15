# Task Management Platform

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  </a>
</p>

## About

This is a **Task Management Platform** built with **Laravel**, a PHP framework with elegant syntax.  
The app allows users to create, assign, and manage tasks efficiently with role-based access for creators, takers, and admins.

---

## Features

- Role-based user access: Creator, Taker, Admin
- Task creation, assignment, and completion
- File attachments for tasks
- Responsive UI with Vite and Blade templates
- Database migrations and seeding for initial data

---

## Requirements

- PHP >= 8.1
- Composer
- MySQL / MariaDB
- Node.js & NPM (for Vite)
- XAMPP or equivalent local server

---

## Installation / Setup

1. **Clone the repository**
```bash
git clone https://github.com/JmAlano04/task-management-platform
cd task-management-platform

Install PHP dependencies

composer install


Install Node dependencies

npm install


Copy the .env file

copy .env.example .env    # Windows
# OR
cp .env.example .env      # Mac/Linux


Generate application key

php artisan key:generate


Set up your database

Create a database in MySQL

Update .env file with database credentials

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password


Run migrations

php artisan migrate


(Optional) Seed the database

php artisan db:seed


Build frontend assets

For development (hot reload):

npm run dev


For production:

npm run build


Start the Laravel development server

php artisan serve
