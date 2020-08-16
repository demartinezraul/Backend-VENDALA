# BACK-END

<br />

## Setting up a development environment

* create a file named .env (copy .env.example file) which should contain the following default setup ( you should provide your own values to this variables ):
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=MY_DB_MANE
DB_USERNAME=MY_DB_USER
DB_PASSWORD=MY_DB_PASSWORD

JWT_SECRET=RuoxLtY4F3HvH3K0aVTkgLPTZu8IvlhJ
```

* Exec `composer install` This cmd witll install all required dependencies
* Exec `php artisan key:generate` to trigger laravel setup
* Exec `php artisan migrate:fresh --seed` to create tables and seed with data

<br />

## Running the app

* Go in the `public` directory 
* Exec `php -S localhost:3000` to start the server
* Login route: /api/users/login [post: email, password],
* Demo credentials email: admin@admin.com, password: admin

Test with POSTMAN first.

Headers ```Content-Type: application/json```

Body/raw data: 
```
{
	"user": {
		"email": "admin@admin.com",
		"password": "admin"
	}
}
```
