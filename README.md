![GitHub release](https://img.shields.io/github/v/release/adizsandy/symfox)
[![GitHub license](https://img.shields.io/github/license/adizsandy/symfox)](https://github.com/adizsandy/symfox/blob/master/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/adizsandy/symfox)](https://GitHub.com/adizsandy/symfox/stargazers/)
![GitHub downloads](https://img.shields.io/github/downloads/adizsandy/symfox/total)

![Symfox: Sunshine Vitamins](https://github.com/adizsandy/symfox/blob/master/public/assets/img/sunshine.png)

# About Symfox 
Symfox is a modular, fast, secure and highly extensible PHP framework built for providing closer to native PHP development experience while following the MVC pattern to its core.

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
- [PHP-DI](https://github.com/PHP-DI/PHP-DI) - Dependency injection container used for black magics :P

## License
MIT

## Installation
- Using composer:
  ``` composer create-project symfox/symfox ```

- Using clone:
  ``` git clone https://github.com/adizsandy/symfox ```
  
  After successfull clone, do not forget to run - 
  ``` composer update ```, which will install all dependencies.

## Basic Documentation
Basic structure of framework is as follows:

- `~/app/` 
  All module related codes reside within this folder.

  To define a module, `<Wrapper>/<ModuleName>` folder structure must be followed.
  For any new module, register module information within `register.php` as :

  ```php
    // Unique Standard Module Name 
    'Wrapper_ModuleName' => [ 

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

- `~/boot/`
  This folder contains files for bootstrapping the application along with its dependencies

- `~/config/`
  This folder consists all configuration files 

- `~/lib/`
  Any third party libraries or common services resides within this folder
  All services must have `Library\\` namespace prefixed.

- `~/misc/`
  Miscellaneous files like helper functions or configurating constants lies in it

- `~/public/`
  All public assets or public domain files reside within it

- `~/vendor/`
  All composer installed packages/dependencies


For setting configurations of project, use `~/.env.example` file and register respective details after  renaming it as : `~/.env`

All public assets can be saved within `~/public/` folder.

In production environment, DO NOT REMEMBER to redirect your server to public folder via `htaccess` as rest of the folders are kept as private folder over production environment.
