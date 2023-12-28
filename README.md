# Laravel Project Setup

This document provides instructions for setting up a Laravel project, creating a MySQL table, and updating the environment configuration.

## Prerequisites

Before you begin, make sure you have the following installed:

- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/manual/en/install.php)
- [MySQL](https://dev.mysql.com/downloads/)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/your-laravel-project.git
    ```

2. Navigate to the project directory:

    ```bash
   git clone https://github.com/your-username/your-laravel-project.git
    ```
3. Install Composer dependencies:
    ```bash
   composer install
    ```
4. Copy the .env.example file to .env:
    ```bash
   cp .env.example .env
    ```
5. Generate an application key:
    ```bash
   php artisan key:generate
    ```
# Database Configuration

## Create a MySQL Database

Create a MySQL database for your project.

## Update the .env file

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

## Running Database Migrations

Run database migrations:

```bash
php artisan migrate:fresh --seed
```

## Starting the Laravel Development Server

To start the Laravel development server, run the following command in your terminal:

```bash
php artisan serve 
```

To link storage folder to public

```bash
php artisan storage:link
```
# Exploring APIs Through Postman

  I have attached  ```Interview.postman_collection.json``` File in the root of project directory. Kindly import it to use it further, instead of virtual hosts i have used simple php artisan serve but yes majority i use Virtual Host Setup

# Viewing Your Laravel Application

Open your browser and visit [http://localhost:8000](http://localhost:8000) to view your Laravel application.

Congratulations! Your Laravel project is now set up and ready to use.

## Test Login Details

For testing purposes, you can use the following login details:

- **Email:** test@example.com
- **Password:** admin@123

## Additional Notes

- **Update the .env file:**
  Make sure to update the .env file with appropriate values for other configurations such as `APP_NAME`, `APP_URL`, etc.

- **Adjust Database Configuration:**
  Customize the database configuration in the .env file based on your specific MySQL setup.

- **Customize Migrations and Seeds:**
  Customize the database migrations and seeds in the `database/migrations` and `database/seeders` directories according to your project requirements.

For more information, refer to the [Laravel Documentation](https://laravel.com/docs).

