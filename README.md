To run this library app first install docker dependencies

Postman API collection of library app:
- https://www.getpostman.com/collections/5e6a7103f8b5940f65c6

Make sure you are not running webserver or mysql on this ports : [80, 443, 3306, 9000]

1. RUN - cp .env.example .env
   Set your environment variables (if you need)

2. RUN - docker-compose up -d

3. RUN - docker exec -it app sh
   Enter to the container in which our library application is run

4. RUN - cd /var/www/html

5. RUN php artisan migrate --seed

6. Exit from container ( RUN - exit )

7. Try postman collection to try API endpoints of Library


GOOD LUCK !
