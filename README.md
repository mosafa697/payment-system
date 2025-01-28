## Sample Payment system

This is a Laravel-based application that provides a payment management system with management customers. It allows administrators to:

-   **Manage Customer**: Create, update, and delete customer accounts.
-   **Control Payments**: Flow with payment plans and integrate it.

The application is built with Laravel for the backend and MySQL for the database. It includes features like authentication, authorization and simple user interface.

## Installation

Follow these steps to set up the application on your local machine.

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/mosafa697/payment-system.git
cd payment-system
```

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer i
```

Install JavaScript dependencies using npm:

```bash
npm i
```

### 3. Set Up Environment File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

Update the `.env` file with your database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

### 4. Run Migrations and Seeders

Run the database migrations to create the necessary tables:

```bash
php artisan migrate
```

Seed the database with initial data (e.g., roles, permissions, and a default admin user):

```bash
php artisan db:seed
```

### 5. Complie Assets

Compile the frontend assets (CSS, JavaScript) using Vite:

```bash
npm run build
```

### 6. Start the Development Server

```bash
php artisan serve
```

Visit the application in your browser at [http://localhost:8000](http://localhost:8000).

## Usage

Access the application:

-   open your browser at [http://localhost:8000](http://localhost:8000).
-   Log in with the default admin credentials:
    -   **Email**: admin@gmail.com
    -   Password: 12345
