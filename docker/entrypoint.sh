#!/bin/bash
set -o pipefail

log() { echo "[$(date -u +'%Y-%m-%dT%H:%M:%SZ')] $*"; }
run_artisan() { php artisan "$@" || return $?; }

log "Starting Laravel application..."

DB_READY=false
DB_HOST_EFFECTIVE="${DB_HOST:-}"
if [ -n "$DB_HOST_EFFECTIVE" ] && [ "$DB_HOST_EFFECTIVE" != "localhost" ] && [ "$DB_HOST_EFFECTIVE" != "127.0.0.1" ]; then
    log "Waiting for database connection at ${DB_HOST_EFFECTIVE}:${DB_PORT:-3306}..."
    if command -v nc >/dev/null 2>&1; then
        counter=0
        max_attempts="${DB_WAIT_MAX_ATTEMPTS:-30}"
        sleep_seconds="${DB_WAIT_SLEEP:-2}"
        while ! nc -z "$DB_HOST_EFFECTIVE" "${DB_PORT:-3306}" 2>/dev/null; do
            counter=$((counter+1))
            if [ "$counter" -ge "$max_attempts" ]; then
                log "Warning: Could not connect to database after ${max_attempts} attempts. Continuing anyway..."
                break
            fi
            log "Waiting for database... (attempt $counter/$max_attempts)"
            sleep "$sleep_seconds"
        done
        if nc -z "$DB_HOST_EFFECTIVE" "${DB_PORT:-3306}" 2>/dev/null; then
            DB_READY=true
        fi
        log "Database connection check complete!"
    else
        log "Skipping database connection check (nc not available)"
        sleep 5
    fi
else
    log "Skipping database connection check (no external database configured)"
fi

# Create storage directories if they don't exist
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache/data
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Idempotent permission fix (only chown when needed) — ensures containers and host devs can write
if [ -d /var/www/html/storage ]; then
  owner=$(stat -c '%U:%G' /var/www/html/storage 2>/dev/null || true)
  if [ "$owner" != "www-data:www-data" ]; then
    log "Fixing ownership for storage and bootstrap/cache..."
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
  fi

  # Directories: setgid so new files inherit group, and group-writable
  find /var/www/html/storage -type d -exec chmod 2775 {} \; || true
  find /var/www/html/storage -type f -exec chmod 664 {} \; || true
  chmod -R 2775 /var/www/html/bootstrap/cache || true
  chmod g+s /var/www/html/storage /var/www/html/bootstrap/cache || true
fi

# Create .env file from environment variables if it doesn't exist
if [ ! -f /var/www/html/.env ]; then
    log "Creating .env file from environment variables..."
    
    # Copy from example or create empty
    if [ -f /var/www/html/.env.example ]; then
        cp /var/www/html/.env.example /var/www/html/.env
    else
        # Create minimal .env file
        cat > /var/www/html/.env <<EOF
APP_NAME="${APP_NAME:-Laravel}"
APP_ENV=${APP_ENV:-production}
APP_KEY=
APP_DEBUG=${APP_DEBUG:-false}
APP_URL=${APP_URL:-http://localhost}

LOG_CHANNEL=${LOG_CHANNEL:-stack}
LOG_LEVEL=${LOG_LEVEL:-error}

DB_CONNECTION=${DB_CONNECTION:-mysql}
DB_HOST=${DB_HOST:-127.0.0.1}
DB_PORT=${DB_PORT:-3306}
DB_DATABASE=${DB_DATABASE:-laravel}
DB_USERNAME=${DB_USERNAME:-root}
DB_PASSWORD=${DB_PASSWORD:-}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
EOF
    fi
fi

escape_sed() { printf '%s' "$1" | sed -e 's/[\/&]/\\&/g'; }
set_env() {
  local key="$1" value="$2"
  local escaped
  escaped=$(escape_sed "$value")
  if grep -q "^${key}=" /var/www/html/.env; then
    sed -i "s/^${key}=.*/${key}=${escaped}/" /var/www/html/.env
  else
    printf "\n%s=%s\n" "$key" "$value" >> /var/www/html/.env
  fi
}

# Update environment variables from runtime environment
log "Updating .env with environment variables..."
[ -n "$APP_KEY" ] && set_env "APP_KEY" "$APP_KEY"
[ -n "$APP_ENV" ] && set_env "APP_ENV" "$APP_ENV"
[ -n "$APP_DEBUG" ] && set_env "APP_DEBUG" "$APP_DEBUG"
[ -n "$APP_URL" ] && set_env "APP_URL" "$APP_URL"
[ -n "$DB_CONNECTION" ] && set_env "DB_CONNECTION" "$DB_CONNECTION"
[ -n "$DB_HOST" ] && set_env "DB_HOST" "$DB_HOST"
[ -n "$DB_PORT" ] && set_env "DB_PORT" "$DB_PORT"
[ -n "$DB_DATABASE" ] && set_env "DB_DATABASE" "$DB_DATABASE"
[ -n "$DB_USERNAME" ] && set_env "DB_USERNAME" "$DB_USERNAME"
[ -n "$DB_PASSWORD" ] && set_env "DB_PASSWORD" "$DB_PASSWORD"
[ -n "$QUEUE_CONNECTION" ] && set_env "QUEUE_CONNECTION" "$QUEUE_CONNECTION"
[ -n "$REDIS_HOST" ] && set_env "REDIS_HOST" "$REDIS_HOST"

# Generate application key if not set
if [ -z "$APP_KEY" ] || ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    log "Generating application key..."
    run_artisan key:generate --force --ansi
fi

# Clear caches
log "Clearing caches..."
run_artisan config:clear || true
run_artisan cache:clear || log "Warning: Could not clear cache (permissions issue - this is normal on first run)"
run_artisan view:clear || true
run_artisan route:clear || true

# Cache configuration for better performance
if [ "$APP_ENV" = "production" ] && [ "${RUN_CONFIG_CACHE:-true}" = "true" ]; then
  log "Caching configuration..."
  run_artisan config:cache || true
  run_artisan route:cache || true
  run_artisan view:cache || true
else
  log "Skipping config/route/view caching (APP_ENV=$APP_ENV, RUN_CONFIG_CACHE=${RUN_CONFIG_CACHE:-true})"
fi

# Run migrations
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
  if [ "$DB_READY" = "true" ]; then
    log "Running migrations..."
    run_artisan migrate --force
  else
    log "Skipping migrations (database not ready)"
  fi
else
  log "Skipping migrations (RUN_MIGRATIONS=false)"
fi

# Run seeders only if database is empty (check users table)
if [ "${RUN_SEEDERS:-auto}" = "true" ]; then
  if [ "$DB_READY" = "true" ]; then
    log "Running seeders (RUN_SEEDERS=true)..."
    run_artisan db:seed --force
  else
    log "Skipping seeders (database not ready)"
  fi
elif [ "${RUN_SEEDERS:-auto}" = "auto" ]; then
  if [ "$DB_READY" = "true" ]; then
    log "Checking if seeders need to run..."
    USER_COUNT=$(php -r 'require "vendor/autoload.php"; $app=require "bootstrap/app.php"; $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap(); echo \App\Models\User::count();' 2>/dev/null || echo "0")
    if [ "$USER_COUNT" = "0" ] || [ -z "$USER_COUNT" ]; then
      log "Database appears empty. Running seeders..."
      run_artisan db:seed --force
    else
      log "Database has $USER_COUNT users. Skipping seeders."
    fi
  else
    log "Skipping seeders (database not ready)"
  fi
else
  log "Skipping seeders (RUN_SEEDERS=${RUN_SEEDERS})"
fi

# Create storage link
if [ ! -L /var/www/html/public/storage ]; then
    log "Creating storage link..."
    run_artisan storage:link
fi

# Test database connection
log "Testing database connection..."
run_artisan migrate:status 2>&1 || log "Warning: Could not connect to database or no migrations found"

# Optimize for production
if [ "${RUN_OPTIMIZE:-true}" = "true" ]; then
  log "Optimizing application..."
  run_artisan optimize || true
else
  log "Skipping optimize (RUN_OPTIMIZE=false)"
fi

# Display environment info for debugging
log "=== Environment Check ==="
log "APP_ENV: $APP_ENV"
log "APP_DEBUG: $APP_DEBUG"
log "DB_HOST: $DB_HOST"
log "DB_DATABASE: $DB_DATABASE"
log "DB_READY: $DB_READY"
log "========================="

log "Laravel application is ready!"

# Execute the main command (Apache)
exec "$@"
