Symfony2 simple api  
===

[![Build Status](https://travis-ci.org/n0ni0/symfony2-simple-api.svg?branch=master)](https://travis-ci.org/n0ni0/symfony2-simple-api) 
[![Coverage Status](https://coveralls.io/repos/github/n0ni0/symfony2-simple-api/badge.svg?branch=master)](https://coveralls.io/github/n0ni0/symfony2-simple-api?branch=master)


This project create a simple rest api using symfony2.  
No authentication required and only return json.  
  

> **[Secured branch with FOSOauthServerBundle](https://github.com/n0ni0/symfony2-simple-api/tree/secured)**


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