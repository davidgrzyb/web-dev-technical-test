# Backend Laravel Application

This is the Laravel application that acts as the API requested in the skills test.

## Seeding

To make it easier to import the `landscapes.json` file, I opted to build a command that imports the data directly from the `landscapes.json` file instead of a traditional Laravel seeder.

```
php artisan data:json:import landscapes.json
```

This command is very simple and includes only the most basic of error handling, however it will take the data from the file (in the base directory of this project) and seed the database after it's been migrated.

## Available Routes

The requested API route for returning the information identical to that of the `landscapes.json` file would be `/api/photographers/1` after migrating and using the command to seed the database.

Other routes that make up the RESTful API:

```
Photographers:
/api/photographers [GET]
/api/photographers [POST]
/api/photographers/{photographer} [GET]
/api/photographers/{photographer} [PUT]
/api/photographers/{photographer} [DELETE]
 
Galleries:
/api/galleries [GET]
/api/galleries/{gallery} [GET]

Photos:
/api/photos [GET]
/api/photos [POST]
/api/photos/{photo} [GET]
/api/photos/{photo} [PUT]
/api/photos/{photo} [DELETE]
```

## Testing

I have included some basic tests for the `PhotographerController` only. Us `php artisan test` to run these tests once the project is installed.

*These tests do not cover every corner case and potential combination of data, and only serve to demonstrate a working knowledge of Laravel backend testing.*