# FlightTrader24 ticket management system

## 1. Installation & Run
1. Clone the project. `git clone git@github.com:hardcommitoneself/flighttrader24-tms.git`
2. Go to the directory. `cd flighttrader24-tms`
3. Install vendor. `composer install`
4. Generate app key. `php artisan key:generate`
5. Get a copy of the `.env.example` `copy .env.example .env`
6. Configurate database. e.g.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=flighttrader24
    DB_USERNAME=root
    DB_PASSWORD=password
    ```
7. Migrate database. `php artisan migrate`
8. Run the app. `php artisan serve`

## 2. API endpoints - you can check the api endpoints through postman or other tools.
1. Create ticket.
    - API: `/api/v1/tickets`
    - METHOD: `POST`
    - REQUEST BODY
        - departure_time: `required|date|after:now`
        - source_airport: `required|string`
        - destination_airport: `required|string`
        - seat: `required|numeric|min:1|max:32|unique_seat`
        - passport_id: `required|string|unique`
2. Cancel ticket.
    - API: `/api/v1/tickets/{id}`
    - METHOD: `DELETE`
    - PARAMS
        - id: `ticket id`
3. Update the seat.
    - API: `/api/v1/tickets/{id}/change-seat`
    - METHOD: `PATCH`
    - PARAMS
        - id: `ticket id`
    - REQUEST BODY
        - seat: `required|numeric|min:1|max:32|not_same_seat`

Thank you!