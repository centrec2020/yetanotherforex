# Yet Another Forex

A Laravel + ExtJS + MySQL application for viewing and managing currency exchange rates, containerized with Docker.

## Prerequisites

Before you start, ensure you have the following installed:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Git

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/centrec2020/yetanotherforex.git
cd yetanotherforex
```

### 2. Configure Environment Variables

Copy the example `.env` file and adjust settings as needed:

```bash
cp .env.example .env
```

Key variables to check in `.env`:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=forex
DB_USERNAME=forex
DB_PASSWORD=forex123
MYSQL_ROOT_PASSWORD=admin123
```

> **Note:** `DB_HOST` must match the MySQL service name in `docker-compose.yml` (usually `mysql`).

### 3. Build and Start Containers

```bash
docker compose build --no-cache
docker compose up -d
```

This will start the following containers:

- `forex_app` (Laravel PHP)
- `forex_nginx` (Nginx web server)
- `forex_mysql` (MySQL database)

### 4. Install PHP Dependencies

Run Composer inside the `app` container:

```bash
docker compose exec app composer install
```

### 5. Generate Application Key

```bash
docker compose exec app php artisan key:generate
```

### 6. Run Migrations and Seeders

```bash
docker compose exec app php artisan migrate:fresh --seed
```

This will create all necessary tables and seed them with sample currency and rate data.

### 7. Access the Application

Open your browser and go to:

```
http://localhost
```

## Development

### Rebuilding Containers

If you make changes to dependencies or Docker-related files, rebuild without cache:

```bash
docker compose build --no-cache
docker compose up -d
```

### Running Artisan Commands

Example:

```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

### Database Access

You can connect to the MySQL container directly:

```bash
docker compose exec mysql mysql -u root -padmin123 forex
```

Or use a GUI client with:

- Host: `127.0.0.1`
- Port: `3307`
- User: `root`
- Password: `admin123`

## Features

- Laravel backend with REST API
- ExtJS frontend with infinite scrolling (lazy loading)
- MySQL database
- Dockerized for easy setup
- Pre-seeded with 50+ currencies and sample rates
- Comes with unit and feature tests
- (Commented function) Additional feature to create new rate

## License

This project is licensed under the MIT License.

## Expected Output

To see the anticipated results from installation through system operation, please open the expected_output.mp4 file.

## Running Unit and Feature Tests

This project includes **unit** and **feature** tests to verify functionality.

### Run All Tests
```bash
docker compose exec app php artisan test
```

### Run Only Unit Tests
```bash
docker compose exec app php artisan test --testsuite=Unit
```

### Run Only Feature Tests
```bash
docker compose exec app php artisan test --testsuite=Feature
```

### Run a Specific Test File
```bash
docker compose exec app php artisan test tests/Feature/RateApiTest.php
```

### Run Tests with Coverage (requires Xdebug enabled)
```bash
docker compose exec app php artisan test --coverage
```
