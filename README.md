# STEPS TO FOLLOW AFTER CLONING THIS PROJECT

Versions
- PHP 7.4
- Laravel 8

Installations and setup
- Install xampp
- After installation of Xampp, open Xampp and turn on MySQL and Apache
- Open localhost/phpmyadmin on a web browser and create a database called ***estateintel***
- Install composer
- Open command prompt or terminal on your PC and navigate to the directory of this project
- Once that is done, run ***composer install*** to install all dependencies
- Run ***cp .env.example .env*** to copy the environment file
- Open the .env file
- In the .env file, set the value of the variable ***DB_DATABASE*** to ***estateintel***
- In the .env file, set ***DB_USERNAME*** and ***DB_PASSWORD*** based on your database configurations

Project structure

config
- config/book.php was added to hold external_books_url variable
- app/Providers/RepositoryServiceProvider.php was registered in config/app.php

migrations
- A migration for the book table was added to database/migrations/2022_03_07_014052_book.php

Model
- The class app/Model/Book.php is the model for the book table

Route
- routes/api.php uses app/Http/Controllers/BookController.php and calls the method fetchExternalBooks to fetch the books from the external api
- routes/api_v1.php uses app/Http/Controllers/Api/v1/BookController.php and inside the controller there are 5 methods that perform CRUD operations on the local database. routes/api_v1.php is registered in app/Providers/RouteServiceProvider.php

Controllers
- app/Http/Controllers/BookController.php and calls the method fetchExternalBooks to fetch the books from the external api has only one method which fetches the external books
- app/Http/Controllers/Api/v1/BookController.php has 5 methods which perform CRUD operations on the local database.
- The two methods make use of the methods of the repository app/Repositories/BookRepository.php which is bound to the interface app/Interfaces/BookRepositoryInterface.php

Interface
- app/Interfaces/BookRepositoryInterface.php contains the set of primary rules or methods that should be implemented by app/Repositories/BookRepository.php

Repository
- app/Repositories/BookRepository.php implements the set of rules created in app/Interfaces/BookRepositoryInterface.php

Service Providers
- app/Providers/RouteServiceProvider.php was used to register the file routes/api_v1.php to handle routes that have prefixes of api/v1
- app/Repositories/BookRepository.php was bound to app/Interfaces/BookRepositoryInterface.php in the register function of app/Providers/RepositoryServiceProvider.php

Service
- app/Services/HttpService.php has the get method to handle the get request of the HTTP client

Form Request
- The form request app/Http/Requests/FetchExternalBooksRequest.php is used to validate that a name is supplied before fetching the external books
- The form request app/Http/Requests/StoreBookRequest.php is used to validate that the data are supplied before creating or updating the book

Resources
- The resources classes found in app/Http/Resources were used to transform the data that was retrieved after a CRUD operation.

Factory
- database/factories/BookFactory.php contains the Book factory

Test
- 15 test cases were written
- PestPHP was used for handling the test cases
- The test cases were written in test/Unit/BookTest.php





