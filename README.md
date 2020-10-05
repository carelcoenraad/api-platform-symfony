# API Platform Symfony

The project is setup based on https://api-platform.com/docs/distribution/.

## Getting Started

### Prerequisites

- Docker

### Start

```bash
docker-compose pull
docker-compuse up -d
```

Go to http://localhost (accept self-signed certificate).

## Development

```bash
# Force database refresh
docker-compose exec php bin/console doctrine:schema:update --force
```

```bash
# Follow the logs
docker-compose logs -f
```
