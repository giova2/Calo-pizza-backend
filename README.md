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

# Advice.

    Database seed is ready for you to do it when you deploy this app, this will make a lot faster the setup of the backend for being ready to be used.

-   To make the migrations appling the seed:
    `php artisan migrate --seed`
