# Pizza-task Backend

This development was made using Laravel 7.

1. ## API
    This code has the functionality of manage the requests from the front-end and add new orders.
2. ## ADMINISTRATION

-   Log in to the system.
-   You will see two sections:

    1. ITEMS:
       In this section you will find an ABM to add items, modified them or "remove" them (in this case is not a deletion from the database, instead of that, you can put it in the status of "Unavailable").

    2. ORDERS:
       In this section you can Access the orders that the frontend users made and approbed them or either reject them. Also you will be able to make orders from this section.


# DEPLOY

1. Create an account on heroku

2. install heroku CLI globally, here are the instructions for MACOS, Windows and Ubuntu: https://devcenter.heroku.com/articles/getting-started-with-nodejs#set-up

3. Execute:
   `$heroku login` from root of our code, and login.

4. Execute:
   `$heroku create NAME_APP`

5. Execute:
    `heroku buildpacks:add heroku/php`
    `heroku buildpacks:add heroku/nodejs`

6. Execute:
   `$git init`

7. We check our remote repository with `git remote -v` (should be a remote with heroku name (repository that was created in step 3.).

8. Execute `$git add .` and `$git commit -m "OUT FIRST COMMIT"` to commit our changes
 
9. Copy all the .env variables to the heroku environment using `heroku config:set KEY=VALUE`
    
10. Execute `$git push heroku master` to do our first deployment

11. Everything should work smoothly.

12. # Advice.

    Database seed is ready for you to do it when you deploy this app, this will make a lot faster the setup of the backend for being ready to be used.

-   To make the migrations appling the seed:
    `php artisan migrate --seed`
