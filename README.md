# Development

```bash
    # run project on background
    docker-compose up -d

    # run database migrations
    docker-compose exec api php artisan migrate
```

### Available cli commands for maintain tasks

Import user and their repositories from github

```bash
    docker-compose exec api php artisan github:import --user=gerardorochin
```

Synchronize all github users and repositories available on database

```bash
    docker-compose exec api php artisan github:sync
```

Note: Every day at midnight automatic synchronize of all github users is executed from command: ```php artisan github:sync```
