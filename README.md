# Laravel Project - Dashboard Starter Pack

This is a Laravel project that includes authentication for user login, a basic dashboard, and user management functionalities such as permissions, roles, and login history tracking.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Login History](#login-history)
- [Contributing](#contributing)
- [License](#license)

## Introduction

This Laravel project is designed to provide a robust user management system with various authentication-related features. It comes with Laravel's built-in authentication system, allowing users to login, and reset their passwords. Additionally, the project includes a basic dashboard with customizable roles and permissions for user management.

## Features

1. User Authentication:
   - Login using email and password.
   - Password reset functionality via email.

2. User Management:
   - Role-based access control system (RBAC) with customizable roles and permissions.
   - Superadmin, admin, and user roles out of the box.
   - Superadmin has full access and can manage roles and permissions.
   - Admins have limited access based on assigned permissions.
   - Users have access to their profiles and limited actions.

3. Dashboard:
   - A basic dashboard with essential user statistics and information.

4. Login History:
   - Keeps track of user login history.
   - Records login timestamp, IP address, and device information.

## Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- MySQL

## Installation

1. Clone the repository:

```shell
git clone https://github.com/AjayKushwaha25/dashboardstarterpack.git
cd your dashboardstarterpack
```

2. Install dependencies:

```shell
composer install
```


3. Create a copy of the `.env.example` file and rename it to `.env`. Update the necessary configurations, including the database settings.

4. Generate the application key:

```shell
php artisan key:generate
```


5. Run the database migrations and seeder to set up the required tables and sample data:

```shell
php artisan migrate --seed
```

## Configuration

1. Roles and Permissions:
   - Assign permissions to roles in the database or using seeder classes.

2. Dashboard:
   - Customize the dashboard view and functionality in the relevant view and controller files.

## Usage

1. Access the application in your web browser.
2. Register a new user with a valid email address.
3. Log in using the registered email and password.
4. Use the dashboard to view user statistics and information.
5. Manage user roles and permissions through the superadmin account.

## Login History

The login history for each user is automatically recorded in the `login_histories` table in the database. You can access this information for analysis and auditing purposes.

## License

This project is licensed under the [MIT License](LICENSE). Feel free to use, modify, and distribute it as per the terms of the license.
