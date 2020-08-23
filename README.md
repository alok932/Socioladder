# Socioladder

This is an sample application for product listing.

### Installation

Visit laravel official docs to setup all requirements (https://laravel.com/docs/)

Update .env file with updated database settings.
Install the dependencies and devDependencies and start the server.

```sh
$ composer install
$ php artisan migrate
$ php artisan serve
```

### Development

To add dummy products.

```sh
$ php artisan tinker
$ factory(App\Product::class, 20)->create()
```
Verify the deployment by navigating to your server address in your preferred browser.

```sh
127.0.0.1:8000
```

To View Admin functionalities navigate to 
```sh
12.0.0.1:8000/admin
```