# [Laravel Boilerplate](https://appseed.us/boilerplate-code/laravel-boilerplate)

Basic [Laravel](https://laravel.com/) starter with [JWT authentication](https://jwt.io/introduction/) and REST api - Provided by **AppSeed** [Web App Generator](https://appseed.us/app-generator).

<br />

> Enjoy this project? **Join our efforts** to actively support the open-source ecosystem via a **[PayPal.me donation](https://paypal.me/appseed)**. Thank you!

<br />

![Open-Source Laravel Boilerplate - Product cover image.](https://github.com/app-generator/static/blob/master/products/boilerplate-code-laravel-boilerplate-cover.jpg?raw=true) 

<br />

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

<br />

## Running the app

* Go in the `public` directory 
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

<br />

## Support

For issues and features request, use **Github** or access the [support page](https://appseed.us/support) provided by **AppSeed** 

<br />

## License
MIT @ [AppSeed](https://appseed.us)

<br />

---
[Laravel Boilerplate](https://appseed.us/boilerplate-code/laravel-boilerplate) provided by **AppSeed**

