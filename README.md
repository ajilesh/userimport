<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

# Laravel Project Setup

## Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL or another database
- Node.js and npm (for frontend assets)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/your-repository.git
    ```

2. Navigate to the project directory:

    ```bash
    cd your-repository
    ```

3. Install PHP dependencies:

    ```bash
    composer install
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. Seed the database (if applicable):

    ```bash
    php artisan db:seed
    ```

8. Install frontend dependencies (if applicable):

    ```bash
    npm install
    ```

9. Compile frontend assets (if applicable):

    ```bash
    npm run dev
    ```

10. Start the development server:

    ```bash
    php artisan serve
    ```

11. Access the application at `http://localhost:8000`.

## Authentication

To access protected routes, use Laravel Sanctum for authentication. You can register and log in users via API endpoints `/api/register` and `/api/login`.

