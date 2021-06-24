![Smitter: Code Smile](https://github.com/adizsandy/smitter/blob/master/public/assets/img/sunshine.png)

![GitHub release](https://img.shields.io/github/v/release/adizsandy/smitter)
[![GitHub license](https://img.shields.io/github/license/adizsandy/smitter)](https://github.com/adizsandy/smitter/blob/master/LICENSE)
[![GitHub stars](https://img.shields.io/github/stars/adizsandy/smitter)](https://GitHub.com/adizsandy/smitter/stargazers/)
![GitHub downloads](https://img.shields.io/github/downloads/adizsandy/smitter/total)

# About Smitter 
Smitter is a modular, fast, secure and highly extensible PHP framework built for providing closer to native PHP development experience while following the MVC pattern to its core.
The purpose of this framework is to maintain the fun and remove the pain of development process while keeping the scalability, security and performance fine tuned irrespective of project conditions.

## Features
- Simple, maintainable, extensible and robust development layer for hassle free and quickest development
- Easiest Public API for implementing all services
- Setting up a project is as quick and fun, as your smile :)
- Built over a powerful service dependency injection layer 

## Installation
- Using composer:
  ``` composer create-project smitter/smitter ```

- Using clone:
  ``` git clone https://github.com/adizsandy/smitter ```
  
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
  A `Wrapper` is recommended to include modules of same kind or submodules.
  Any submodule is defined as a parallel module within same wrapper, just `parent` field is set to the name of `ParentModuleName` in module registry.

  For example, to define a sub-module of `Wrapper_ModuleName`, `<Wrapper>/<SubModuleName>` folder structure must be followed.
  
  Within `register.php`:

  ```php
    // Unique Standard Module Name 
    'Wrapper_SubModuleName' => [ 
        'active' => true,
        'parent' => 'Wrapper_ModuleName'
    ] 
  ```

  Each module consist of a module definition file `module.php` and `routes.php`, which has module declarations and module specific route definitions respectively.

  Folder structure within module consists of `Controller`, `Design` [ `layouts`, `templates` ], `Model` folders with respective functionalities.

  `Controller` :  
  
    In Smitter, Controllers are just plain and independent PHP classes, used for handling the requests and providing the response.<br>
    All extensible features like Request Parameters, Response Processe, Session etc. can be handled by the helper functions available with equivalent names :)

    ```php

    namespace App\Main\Module\Controller;

    class HomeController { 
      //..... code resides here
    }

    ```
  
  `Model` : 
  
    Model classes include business logics that maybe database related depending on requirements.
    
    If database related logics are to be handled, the class should extend the `Illuminate\Database\Eloquent\Model` class, for implementing the complete ORM features of `Eloquent ORM` and mapping the model as an database `Entity`. 
    
    However if you need to just run SQL queries anywhere within your codebase, you may use the `db()` function, which returns the Eloquent instance. 

    ```php 
    
    namespace App\Main\Module\Model;

    use Illuminate\Database\Eloquent\Model;

    class User extends Model {
        
        protected $table = 'users';  
    }
    
    ```

  `Design` : 
    It includes the VIEW logics, having `layouts` and `templates` folder.

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
