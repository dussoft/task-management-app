# Task Management Web Application

This is a simple Laravel web application for task management. It allows you to create, edit, and delete tasks, as well as reorder them using drag and drop functionality.

## Requirements

- PHP 7.4 or higher
- Laravel 8.x
- MySQL database

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/dussoft/task-management-app.git

2. Change to the project directory:
    ```bash
    cd task-management-app

3. Install the dependencies using Composer:
    ```bash
    composer install

4. Configure the environment variables:
    ```bash
    . Rename the .env.example file to .env.
    . Update the .env file with your database credentials

5. Generate an application key:
    ```bash
    php artisan key:generate

6. Run the database migrations
    ```bash
    php artisan migrate

7. Serve the application
    ```bash
    php artisan serve

8. Open your browser and visit http://localhost:8000 to see the application.