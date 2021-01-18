# NASA APOD overview

The NASA APOD overview website/web-app uses the APOD API to retrieve the NASA Astronomy Picture of the Day. It then saves them to a (local) database and uses the database results to create a web page with an overview of the APODs for the last 31 days.

This project was created using Laravel, a modern PHP web framework.

## Installation

1. Download the project.
2. Once downloaded and set up on your local machine, `cd` to your project location and run `composer install` to install the needed dependencies.
3. Make sure your environment is set up properly. If you do not have an `.env` file, rename `.env.example` to `.env` and use this file to set everything up.
    - create a database for your application, we use [HeidiSQL](https://www.heidisql.com/) for database management.
    - insert your database credentials in the `.env` file. Make sure you enter the credentials in this section of the `.env` file. (see below)

    ![DB settings in the .env file](https://i.imgur.com/Q1I5HVH.png)
    
4. Open your terminal, initialise the project and fill the database.
    - run `php artisan key:generate` to set the application key.
    - run `php artisan migrate` to populate the newly created database.
    - (optional) run `php artisan getpictures` to manually get NASA APODs for the first time, this fills the database.
    - run `php artisan schedule:work`, this will automatically run the command above every 30 minutes. Your application will automatically get the last 31 (today + previous 30) NASA APODs and save them to the database.
        - existing pictures in the local database will not be saved twice.
        - the `getpictures` job is currently set to use NASA's DEMO API KEY, which is limited to 30 requests per IP address per hour, and 50 requests per IP address per day. Consider signing up for [your own API key](https://api.nasa.gov/) if you need more requests.
            - for demo purposes, the DEMO key should work fine. (2 requests an hour, 48 a day)
    
5. Run your application.
    - run `php artisan serve` to serve the application locally and preview it in the browser.
        - the development server should start on the `8000` port.
            - or easier: navigate to `http://127.0.0.1:8000` in your web browser.