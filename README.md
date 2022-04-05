# Recipe app backend

This is the backend part of the 6th assignment for Fullstack Developer students at Chas Academy.

The repository contains an API, built with Laravel, for registering and authenticating users as well as managing recipe lists for individual users.

## Setup

#### The following steps are assuming you already have Docker installed.

### Run Locally

Clone the project and go to the project directory

```bash
  $ git clone git@github.com:NovaBoman/recipe-app-be.git
  $ cd recipe-app-be/
```

Start Docker containers

```bash
  $ docker compose up
```

Open the project with your editor.
In your `/recipe-app/.env` file add the following:

```php
  DB_CONNECTION=mysql
  DB_HOST=db
  DB_PORT=3306
  DB_DATABASE=<your database name>
  DB_USERNAME=<your username>
  DB_PASSWORD=<your password>
```

Go to [Adminer](http://localhost:8080).  
Make sure Server is set do "db".  
Log in with the credentials you added to the `.env` file. and create a database with the name you added to:

```bash
  DB_DATABASE=
```

In your terminal attach a shell to your PHP-container.  
To find the container ID and attach the shell run the following command.

```bash
  $ docker ps
  $ docker exec -it <container id> bash
```

Go to project folder and run migrations

```bash
  $ cd recipe-app/
  $ php artisan migrate
```

Serve the application

```bash
  php artisan serve --host 0.0.0.0 --port 8000
```

Open your [browser](http://localhost:8000) and make sure your application is running.
