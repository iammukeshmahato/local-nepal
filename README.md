# Local Nepal

## Table of Contents

-   [Introduction](#introduction)
-   [Technologies](#technologies)
-   [Installation](#installation)
-   [Contributing](#contributing)
-   [Author](#author)

## Introduction

Local Nepal is a web application designed to streamline and simplify guide booking task. In this system, the user can book a guide for a particular place. The user can also see the details of the guide and the place. This system provides a centralized platform for users to organize and manage all aspects of guide booking.

## Technologies

-   HTML
-   CSS
-   JavaScript
-   Bootstrap
-   Laravel
-   MySQL

## Installation

**Note:** Make sure you have composer and laravel installed in your system. If not,
click [here](https://www.javatpoint.com/how-to-install-laravel-on-mac) to follow the installation guide.

1. Clone the repository
2. Navigate to the project directory and open in vs code or any other editor

```bash
cd Local-Nepal
```

3. Install the required packages

```bash
composer install
```

4. Make a copy of the `.env.example` file and rename it to `.env`

```bash
cp .env.example .env
```

**Note:** You can manually copy the file and rename it to `.env`

5. Generate the application key

```bash
php artisan key:generate
```

6. Create a `local-nepal` database in MySQL

7. Migrate and seed the database

```bash
php artisan migrate --seed
```

8. Now run the application

```bash
php artisan serve
```

9. Open the browser and go to the following link or the respective link provided by the serve command

```bash
http://127.0.0.1:8000/
```

## Contributing

-   Fork the repo [local-nepal](https://github.com/iammukeshmahato/local-nepal)
-   Commit your changes
-   Create pull request mentioning comment regarding your changes

## Author

-   [Mukesh Mahato](https://github.com/iammukeshmahato)
