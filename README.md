# Personal Task Manager

**Project Code:** WST21-PM-2026-SF
**Student Name:** Kyle Lugod
**Course & Year:** BSIS-2
**Database Used:** SQLite

## Project Description

Personal Task Manager is a simple Laravel web application for organizing daily tasks in one place. It allows users to add, view, edit, delete, and update the status of tasks as either pending or completed. The project demonstrates a complete Laravel workflow using routes, controllers, models, database migrations, and Blade views.

## Purpose

The purpose of this project is to provide a lightweight task-tracking tool that helps users keep work organized, monitor progress, and clearly identify completed activities.

## Features

- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status
  - Pending
  - Completed

## Technology Stack

- Laravel
- PHP
- SQLite
- Blade
- HTML and CSS

## Running the Project

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Open the application at `http://localhost:8000` or use the forwarded port URL provided by VS Code.
