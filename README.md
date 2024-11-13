# Zimou Technical test

1. Create login/register UI
1. Create 5000 Stores for each store add 100 packages using seed or factories
1. Create item in the menu to show packages with the following columns: tracking_code, store name, package name, status, client full name, phone, wilaya, commune, delivery type, status name
1. Add a button to export all the packages in csv or excel file with the same columns above
1. (optional) If you add create package will be an extra point 😉

Notes:

- Dont need to send a PR, just fork the repo and work on your repo
- Please keep the commits and the DB structure as it is
- You are free to use any third party package or any UI dashboard

Good luck 😃




Important Instructions

After cloning the repository, follow these steps:

    Install Dependencies:
    Run the following commands to install all dependencies:

npm install
composer install


Run Migrations:
Initialize the database structure with:

php artisan migrate

Seed the Database:
Populate the database with initial data:

php artisan db:seed --class=DatabaseSeeder

Launch the Application:
In separate terminals, run:

npm run dev    # For the frontend
php artisan serve    # For the backend

Access the Application:

    You can log in with the following credentials:
        Email: admin@example.com
        Password: password
    Alternatively, you can create a new user by using the sign-up link on the login page.