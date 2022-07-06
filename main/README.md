# Real Estate Management System.

## Development environment setup
- Clone this repo.
- Go to project root directory and then,
  - Install Composer dependency with `composer install`.
  - Install node dependency with `npm install`.
- Duplicate *.env.example* file to *.env*. `cp .env.example .env`.
- Adjust database connection in `config/database.php` and `.env` file.
- First register one user as an admin, do it manually, the user will be saved as user "role", check the database table "users" and change that user role into "admin", then you can register other users without any manual work.
- Run migration and seed `php artisan migrate:refresh --seed`
- Generate encryption key `php artisan key:generate`
- Copy file `webpack.mix.js-sample` to `webpack.mix.js` and adjust properties if required.
- Run `npm run dev` for front end assets compilation.
- Run  `php artisan serve ` to begin the system.

Then the site should be accessible via browser with your site (VM) URL.
4242424242424242

## For testing 
- Go to project root directory then,
    - run `vendor/bin/phpunit --no-coverage`
    - To run test with coverage report
        - First you need to enable xdebug in your server
        - Run `vendor/bin/phpunit`. It generates report in report dir in your project
        
    

## Assets Compilation and browsersync
   - Please see [Laravel mix documentation](https://laravel.com/docs/8.x/mix)

## Production deployment
  - Do not deploy manually, Instead use [Deployer](https://deployer.org/)(Deployer script will be prepared/added later)
