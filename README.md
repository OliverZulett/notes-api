<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

notes api its the API built in Laravel that handles all the request and backend functionalities for Notes Apps

## required software

- docker 
- docker-compose

## To run the project

execute the next command in order

1. Install composer dependencies:

``` bash
docker run --rm -v $(pwd):/app composer install
```
2. Start project
``` bash
./vendor/bin/sail up 
```
3. migrate database
``` bash
./vendor/bin/sail artisan migrate
```
4. seed database
``` bash
./vendor/bin/sail artisan db:seed 
```
## commands

1. to create migration

``` bash
./vendor/bin/sail artisan make:migration Category
 
```

2. to create factory

``` bash
./vendor/bin/sail artisan make NoteFactory
 
```

3. to create seeder

``` bash
./vendor/bin/sail artisan make:seeder UsersSeeder
 
```
4. to create controller & model

``` bash
./vendor/bin/sail artisan make:controller api/UserController --api --model=User
 
```
5. to create resource

``` bash
./vendor/bin/sail artisan make:resource UserResource  
 
```

6. to create request

``` bash
./vendor/bin/sail artisan make:request StoreUserRequest
 
```