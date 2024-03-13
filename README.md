<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to set up and run this code

First you have to install XAMPP and Composer

### Xamp
You can install xampp with this link below
https://www.apachefriends.org/download.html

After you install XAMPP, make sure to start MySql and Apache server, this will make your database up.
![img.png](https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.ionos.com%2Fdigitalguide%2Ffileadmin%2FDigitalGuide%2FScreenshots%2FEN_XAMPP_Control_Panel_2.PNG&f=1&nofb=1&ipt=adbf52e95960c195ea2b31c7faf34f04881d3dc3034c7ef12716921bef378b41&ipo=images)

### Composer

Just follow the instructions here https://getcomposer.org/download/ to install composer locally

### .env
You will see a .env.example, locally you can just copy the cont ent of .env.example and paste at .env, but make sure to
change the ``DB_DATABASE`` value to the name you wish to your database.
````dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
````
On docker container, the ``DB_HOST`` should have, before the ip, the name of the database container, so it will end up like
this
````dotenv
DB_HOST=my_db-1#127.0.0.1
````

###  Install packages and set up the migrations
Run the codes below at the root directory of this project, the first one will install all the packages required to run the API, the last command will migrate
the table and columns to your database, make sure to configured correctly your .env to connect at your database.
````shell
composer install
php artisan migrate
````

### Running
To run the project just run the code:
````shell
php artisan serve
````
For default Laravel run the application on the port 8000, but if you already have something going on in this port just
pass the flag ``--port=wished_port``, I like to run in the port 3080, so I do
````shell
php artisan serve --port=3080
````

### Tests
To run the tests is pretty simple, run the command below
````shell
php artisan test
````

### Docs
To generate the documentation run the command below. It will be generated at *localhost:port/api/documentation*
````shell
php artisan l5-swagger:generate
````

## Docker
You can also use docker to run this app, after clone the app on your desktop just follow the commands [here](https://github.com/cromero2386/laravel10-nginx).
Thanks to [cromero2386](https://github.com/cromero2386/laravel10-nginx/commits?author=cromero2386) for the docker container.
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
