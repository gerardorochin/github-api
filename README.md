# Development

```bash
    # run project on background
    docker-compose up -d

    # run database migrations
    docker-compose exec api php artisan migrate

    # import user and repositories via cli
    docker-compose exec api php artisan github:import --user=gerardorochin
```
