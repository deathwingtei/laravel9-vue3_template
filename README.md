require php version > 8.0

How to run

1. copy .env.example to .env for edit environment (DB)

2. run command "composer install" (Install composer to machine first) AND run command "npm install" (Install node and npm to machine first) in your terminal for add required resource

3. Database

3.1. use migrate

    3.1.1. create database on dbms (such as phpmyadmin) name test_add_edit_delete or any name in .env DB_DATABASE

    3.1.2. change database usename password in .env

    3.1.3. run : "php artisan migrate" on git bash or any terminal

3.2. import database from folder DB to dbms by create database name like name in .env DB_DATABASE 

4. Run 

run php artisan serve and npm run dev (or npm run build) for watch result

**if keytgen wrong let create new