![GitHub release](https://img.shields.io/badge/release-21.03.06-orange)
[![GitHub license](https://img.shields.io/github/license/adizsandy/symfox)](https://github.com/adizsandy/symfox/blob/master/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/adizsandy/symfox)](https://GitHub.com/adizsandy/symfox/stargazers/)

# Symfox 

## Agile, Extensible, Fast and Modular PHP Framework 

## Features
- Seperation of common development layer from the abstractions/source code
- Easiest Public API for implementing all available services
- Flexible project architecture, i.e., Can be used as modular or normal
- Built on the top of a powerful service dependency injection layer

## Tech
Symfox uses several best components of different open source libraries:

- [Symfony](https://symfony.com/) - Core of Symfox: HTTP Foundation, Routing, Event Dispatcher, DotEnv and Security Components
- [Eloquent ORM](https://laravel.com/docs/5.0/eloquent) - ORM implementation for database relations and operations 
- [Flysystem](https://github.com/thephpleague/flysystem) - Library used for including robust file handling features 

## License
MIT

## Installation
- Using composer:
  ``` composer create-project symfox/web-framework ```

- Using clone:
  ``` git clone https://github.com/adizsandy/symfox ```

## Basic Documentation
All custom development sources must reside within `~/app` folder.

It is divided in three parts: 
- `~/app/helpers` folder consists of custom helper functions.
- `~/app/modules` folder consists of all main development sources

    To define a module, `<Title>/<ModuleName>` folder structure must be followed.

    For any new module, register module information within `~/app/modules/register.php` as :

```php
        // Unique Standard Module Name 
        'Title_ModuleName' => [ 

             // SWITCH: Turn active/inactive a given module
            'active' => true,
            
            /**
            * INHERITANCE: If given module is a submodule or dependant on other modules, if there is any, put 'Standard Module Name' of that parent module for the same Only single inheritance is   allowed for now.
            */
            'parent' => false  
        ] 
```
Each module consist of a module definition file `module.php` and `routes.php`, which has module declarations and module specific route definitions respectively.

Folder structure within module consists of `Controller`, `Design` [ `layouts`, `templates` ], `Model` folders with respective functionalities.

By default, `Main_Module` is provided for quick setup of simple and uni-modular web applications along with some basic information for creation of other modules.

- `~/app/common` folder consists of common shared services/libraries to be used by different modules independently.

For setting configurations of project, use `~/.env.example` file and register respective details after  renaming it as : `~/.env`

All public assets can be saved within `~/public/` folder.

In production environment, ALWAYS redirect your server to public folder via `htaccess` as rest of the folders are kept as private folder over production environment.
