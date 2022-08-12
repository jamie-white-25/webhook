## Webhook Test

I've completed the test to the best of my ability, but please note I've never used webhooks before. I've not added any authentication for this test, but I would use sanctum to authenticate the API endpoints before deploying to production.  

## Setup

- sail command 
./vendor/bin/sail

This test is using laravel sail, so you will need docker to run this. To get started run composer install. To run the sail commands you need to run 
./vendor/bin/sail, so to run artisan you'll need to run ./vendor/bin/sail artisan. Rename the .env.example to .env and set the database password as password and run the sail command up -d this should start the docker containers. 

Once the containers have started, generate the the APP_KEY, and then run the sail command artisan sail:install and install mySQL, and once that is done then you can run the sail command and migrate and seed the database. 

## Database structure

I've created 4 migrations files, 1 for the events, podcasts, episodes, and one for the polymorphic relationships. I set the relationships up so podcasts, episodes, can have a many to many relationship with events, and this would make querying events with different types alot easier. 

## Tests

All tests are feature tests and I've created tests as I've been developing TDD principles to catch if any of the functionality were to be broken. 

To run the test run the ./vendor/bin/sail test and this will run the tests. 

All tests are feature tests and I've created tests to catch if any of the funcationity were to be broken. 

To run the test run the ./vendor/bin/sail test and this will run the tests. 
