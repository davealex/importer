# Importer

A service for incrementally migrating data from a file source to a database system.

The service is implemented on [Laravel 9.3.1](https://github.com/laravel/laravel/tree/v9.1.0) framework. The official documentation can be found on the [Laravel website](https://laravel.com/docs/9.x).

## Server Requirements
- PHP 8.0 - 8.1

## Installation
You can install the application either by cloning the repository from GitHub:

## Clone repository
Clone this project with:

`git clone git@github.com:davealex/importer.git`
or
`git clone https://github.com/davealex/importer.git`

Ensure you're on the `main` branch.

## Setup
1. cd into project root directory: `cd importer`
2. install project dependencies: `php artisan install`
3. Copy `.env.example` and rename to `.env` in the project's root directory
4. Run `php artisan key:generate` to set application's encryption key `APP_KEY` in the `.env` file;
or `cp .env.example .env && php artisan key:generate`, if you'd rather get 3 & 4 done in one fell swoop
5. Configure the database within the `.env` file by setting appropriate values for the `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc., environment variables
6. Configure Cache if you won't be using the default cache driver

## Running the program
- Run database migrations to create relevant database tables: `php artisan migrate`
- Importing data from file and save to database: `php artisan import:data {file_path}` 
e.g. `php artisan import:data challenge.json`, which assumes you have a file named `challenge.json` in `/storage/app/data` directory


## Testing
Run test suites: `php artisan test`

## Development note
This project utilizes [JSON Machine - PHP JSON stream parser](https://github.com/halaxa/json-machine) under the hood, to sort of lazy load JSON data from file to avoid loading huge datasets into memory. The solution can be easily extended to also process `XML` and `CSV` files.
