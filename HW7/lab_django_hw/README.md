# django & docker practice
- run container
```
docker-compose up
```
- remove container
```
docker-compose down
```
- open website
```
127.0.0.1:8000/movie/home

web_migrate:
  extends:
    service: web
  command: python manage.py migrate
```
