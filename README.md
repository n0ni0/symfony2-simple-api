Symfony2 simple api  
===

Secured branch
--

This project create a simple rest api using symfony2.  
Use FOSOauthServerBundle to secured routes  

**Installation**
-----------------

- Clone the repository from github

```
$ git clone git@github.com:n0ni0/symfony2-simple-api.git <your-path-to-install>
$ cd <your-path-to-install>
```

- Use Composer to get the dependencies

```
$ composer install
```

-  Set up the Database and load example dates

```
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:create
$ php app/console doctrine:fixtures:load
```

- Run a built-in web server

```
$ php app/console server:run
```

- And type in your favourite browser:

```
http://127.0.0.1:8000
```

> **NOTE**
>
> To use built-in web server you need PHP 5.4 or higher
> http://http://symfony.com/doc/current/cookbook/web_server/built_in.html
>
> If you're using PHP 5.3, configure your web server to point at the web/ directory of the project.
> http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
>