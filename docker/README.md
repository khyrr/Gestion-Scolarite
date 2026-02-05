# Docker Deployment Guide

This Laravel application can be deployed using Docker and Docker Compose.

## Prerequisites

- Docker installed (version 20.10 or higher)
- Docker Compose installed (version 2.0 or higher)

## Quick Start

### 1. Prepare Environment File

```bash
# Copy the Docker environment template
cp .env.docker .env

# Edit .env and set your configurations
nano .env
```

**Important:** Generate a new APP_KEY:
```bash
php artisan key:generate
```
Or manually set it in .env

### 2. Build and Start Containers

```bash
# Build the Docker images
docker-compose build

# Start all containers
docker-compose up -d
```

### 3. Run Initial Setup

```bash
# Access the app container
docker-compose exec app bash

# Run migrations
php artisan migrate --seed

# Exit container
exit
```

### 4. Access the Application

- **Application**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080

## Available Commands

### Container Management

```bash
# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs -f app

# Restart containers
docker-compose restart

# Rebuild containers
docker-compose build --no-cache
docker-compose up -d --force-recreate
```

### Laravel Artisan Commands

```bash
# Run artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:list

# Access container shell
docker-compose exec app bash

# Run composer commands
docker-compose exec app composer install
docker-compose exec app composer update
```

### Database Management

```bash
# Access MySQL
docker-compose exec db mysql -u gestion_user -p

# Backup database
docker-compose exec db mysqldump -u gestion_user -p gestion_scolarite > backup.sql

# Restore database
docker-compose exec -T db mysql -u gestion_user -p gestion_scolarite < backup.sql

# Import existing backup
docker-compose exec -T db mysql -u gestion_user -p gestion_scolarite < backups/your_backup.sql
```

## Service Details

### App Service (Laravel)
- **Container Name**: gestion-scolarite-app
- **Port**: 8000
- **PHP Version**: 8.2
- **Web Server**: Apache

### Database Service (MySQL)
This project uses **MySQL** by default inside Docker for demo and development.
- **Container Name**: gestion-scolarite-db
- **Port**: 3307 (host) → 3306 (container)
- **MySQL Version**: 8.0
- **Volume**: dbdata (persistent storage)

To use MySQL in Docker (default):
1. In `.env.docker` ensure the following (already set by default):
   - `DB_CONNECTION=mysql`
   - `DB_HOST=db`
   - `DB_PORT=3306`
   - `DB_DATABASE=gestionscolarite`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=root`
2. Rebuild and recreate containers:
   - `docker compose down -v`
   - `docker compose up -d --build`
3. Run migrations/seeds inside the app container:
   - `docker compose exec app php artisan migrate --seed`

Notes:
- The Dockerfile already includes `pdo_mysql` and `pdo_pgsql` support. MySQL is the default for this project.
- If you still want to use PostgreSQL, you can add a `pg` service and switch `.env.docker` accordingly (we previously experimented with this).

### phpMyAdmin Service
- **Container Name**: gestion-scolarite-phpmyadmin
- **Port**: 8080
- **Access**: http://localhost:8080

## Production Deployment

### 1. Security Checklist

- [ ] Set `APP_ENV=production` in .env
- [ ] Set `APP_DEBUG=false` in .env
- [ ] Use strong passwords for DB_PASSWORD
- [ ] Generate new APP_KEY
- [ ] Configure HTTPS/SSL
- [ ] Set up firewall rules
- [ ] Enable log rotation
- [ ] Configure backups

### 2. Performance Optimization

```bash
# Cache configuration
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Optimize composer autoload
docker-compose exec app composer install --optimize-autoloader --no-dev
```

### 3. Monitoring

```bash
# View container stats
docker stats

# Check container health
docker-compose ps

# Monitor logs
docker-compose logs -f --tail=100 app
```

## Troubleshooting

### Permission Issues

The container's entrypoint now ensures `storage` and `bootstrap/cache` have correct ownership when the container starts. For local development with bind mounts, run these on your host (once):

```bash
# Add yourself to the www-data group (logout/login required)
sudo usermod -aG www-data $USER
# Fix local ownership and perms so both host user and www-data can write
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 2775 storage bootstrap/cache
```

If you're dealing with a named volume or want to fix permissions from inside the container (CI or recovery):

```bash
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 2775 storage bootstrap/cache
```

### Database Connection Issues

```bash
# Check if database is ready
docker-compose exec app nc -z db 3306

# Restart database
docker-compose restart db
```

### Clear All Caches

```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Reset Everything

```bash
# Stop and remove containers
docker-compose down

# Remove volumes (WARNING: This deletes database data!)
docker-compose down -v

# Rebuild from scratch
docker-compose build --no-cache
docker-compose up -d
```

## File Structure

```
.
├── docker/
│   ├── apache/
│   │   └── 000-default.conf    # Apache virtual host config
│   ├── php/
│   │   └── php.ini              # PHP configuration
│   ├── mysql/
│   │   └── my.cnf               # MySQL configuration
│   ├── entrypoint.sh            # Container startup script
│   └── README.md                # This file
├── Dockerfile                    # Docker image definition
├── docker-compose.yml           # Docker Compose configuration
├── .dockerignore                # Files to exclude from Docker build
└── .env.docker                  # Docker environment template
```

## Support

For issues or questions:
- Check logs: `docker-compose logs -f`
- Review container status: `docker-compose ps`
- Inspect containers: `docker-compose exec app bash`
