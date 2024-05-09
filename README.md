# Codyfight bot

## Project setup

### Environment
```shell
cp .env.example .env
```

### Start Docker containers

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### Generate application key

```shell
vendor/bin/sail artisan key:generate
```

### Launch Docker services

```shell
vendor/bin/sail up -d
```

### Database

```shell
vendor/bin/sail artisan migrate
```

### Frontend

```shell
vendor/bin/sail npm install
vendor/bin/sail npm run build
```
