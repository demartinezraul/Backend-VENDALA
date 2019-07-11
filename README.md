# Laravel Boilerplate

Basic Laravel starter with JWT authentication and REST api

--- 

## Setting up a development environment

* clone repo: `git clone https://github.com/app-generator/laravel-starter.git`
* change directory to laravel-starter: 
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

## Running the app

* Go in the appseed/starter-laravel/public run in 
* Exec `php -S localhost:3000` to start the server
* Login route: /api/users/login [post: email, password],
* Demo credentials email: demo@appseed.us, password: demo & demo2@appseed.us, password: demo

Test with POSTMAN first.

Headers ```Content-Type: application/json```

Body/raw data: 
```
{
	"user": {
		"email": "demo2@appseed.us",
		"password": "demo"
	}
}
```

## Support
Open a [new issue](https://github.com/app-generator/nodejs-starter/issues/new) here 
or contact [AppSeed support](https://appseed.us/support) 

## License
MIT @ [AppSeed](https://appseed.us)
