# 🚀 Deployment Guide - Gestion Scolarité on Koyeb

## 📋 Table of Contents
1. [Production Environment Variables](#-production-environment-variables)
2. [Security Configuration](#-security-configuration)
3. [Koyeb Deployment Steps](#-koyeb-deployment-steps)
4. [Database Setup](#-database-setup)
5. [HTTPS & SSL Configuration](#-https--ssl-configuration)
6. [Performance Optimization](#-performance-optimization)
7. [Monitoring & Logging](#-monitoring--logging)
8. [Troubleshooting](#-troubleshooting)

---

## 🔐 Production Environment Variables

### How to Configure in Koyeb

1. **Login to Koyeb Dashboard**: https://app.koyeb.com
2. **Navigate to Your App**: "your-app-name"
3. **Go to Settings** → **Environment Variables**
4. **Add/Update the following variables**:

### ✅ Required Variables (CRITICAL)

```bash
# Application
APP_NAME="Gestion Scolarité"
APP_ENV=production
APP_DEBUG=false  # ⚠️ MUST be false in production
APP_KEY=your-app-key-here  # Generate with: php artisan key:generate --show
APP_URL=https://your-app-name.koyeb.app

# Database
DB_CONNECTION=mysql
DB_HOST=your-database-host.com
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password

# Security
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
TRUSTED_PROXIES=*

# Logging
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

### 📧 Email Configuration (Recommended)

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@ecole.mr"
MAIL_FROM_NAME="Gestion Scolarité"
```

**How to get Gmail App Password:**
1. Go to Google Account → Security
2. Enable 2-Step Verification
3. Search for "App passwords"
4. Create password for "Mail"
5. Use the 16-character password

### 🎯 Optional But Recommended

```bash
# Timezone & Locale
APP_TIMEZONE=UTC
APP_LOCALE=fr
APP_FALLBACK_LOCALE=en

# Cache (for better performance)
CACHE_DRIVER=file
CACHE_PREFIX=gestion_scolarite_cache

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=.koyeb.app

# Contact Information
CONTACT_EMAIL="contact@ecole.mr"
CONTACT_PHONE="+222 XX XX XX XX"
SCHOOL_NAME="Gestion Scolarité"
```

---

## 🔒 Security Configuration

### Critical Security Checklist

- [x] ✅ **APP_DEBUG=false** - Never enable debug in production
- [x] ✅ **APP_ENV=production** - Ensures production optimizations
- [x] ✅ **Strong APP_KEY** - Encrypts sessions, passwords, data
- [x] ✅ **HTTPS Enforced** - APP_URL uses https://
- [x] ✅ **Secure Cookies** - SESSION_SECURE_COOKIE=true
- [x] ✅ **Database Credentials** - Use strong passwords
- [x] ✅ **Trusted Proxies** - Configured for Koyeb
- [x] ✅ **Error Logging** - LOG_LEVEL=error (not debug)

### How to Rotate APP_KEY (if needed)

⚠️ **WARNING**: Rotating APP_KEY will invalidate all existing sessions

```bash
# Generate new key locally
php artisan key:generate --show

# Update in Koyeb environment variables
# Redeploy the application
```

### Database Security Best Practices

1. **Use SSL for Database Connection** (if Clever Cloud supports it):
   ```bash
   MYSQL_ATTR_SSL_CA=/path/to/ca-cert.pem
   ```

2. **Regular Password Rotation**: Change database password every 90 days

3. **Database Backups**: Automated daily backups (see Backup Strategy section)

---

## 🌐 HTTPS & SSL Configuration

### Koyeb Automatic HTTPS

✅ Koyeb provides automatic HTTPS with valid SSL certificates!

**Your URLs:**
- Production: https://your-app-name.koyeb.app
- All HTTP requests are automatically redirected to HTTPS

### Verify HTTPS is Working

1. **Check Certificate**: Click padlock icon in browser
2. **Force HTTPS in Laravel**: Already configured in `.env.production`
   ```bash
   APP_URL=https://your-app-name.koyeb.app
   SESSION_SECURE_COOKIE=true
   ```

3. **Mixed Content Check**: Ensure all assets use HTTPS
   ```bash
   ASSET_URL=https://your-app-name.koyeb.app
   ```

### Custom Domain (Optional)

If you want to use your own domain (e.g., `ecole.mr`):

1. **In Koyeb Dashboard**:
   - Go to App Settings → Domains
   - Click "Add custom domain"
   - Enter your domain: `www.ecole.mr`

2. **DNS Configuration** (at your domain registrar):
   ```
   Type: CNAME
   Name: www
   Value: your-app-name.koyeb.app
   TTL: 300
   ```

3. **Update Environment Variables**:
   ```bash
   APP_URL=https://www.ecole.mr
   SESSION_DOMAIN=.ecole.mr
   ```

---

## 💾 Database Setup

### Current Configuration

- **Provider**: Clever Cloud MySQL 8.0
- **Host**: your-database-host.com
- **Database**: your-database-name
- **Status**: ✅ 27 migrations completed

### Backup Strategy

**Recommended**: Automated daily backups

#### Option 1: Clever Cloud Backups (Easiest)
1. Login to Clever Cloud Console
2. Go to your MySQL add-on
3. Enable automatic backups
4. Configure retention period (30 days recommended)

#### Option 2: Laravel Backup Package
```bash
# Install Laravel Backup
composer require spatie/laravel-backup

# Configure in config/backup.php
# Set up cron job for daily backups
# Store backups on AWS S3 or Google Cloud Storage
```

#### Option 3: Manual Backups (Current Method)
```bash
# Export database (run locally or in Koyeb terminal)
php artisan db:backup

# Or use mysqldump directly
mysqldump -h your-database-host.com \
  -u your-database-username \
  -p your-database-name > backup_$(date +%Y%m%d).sql
```

### Database Migrations

Migrations run automatically during deployment via `docker/entrypoint.sh`:

```bash
# Check migration status
php artisan migrate:status

# Run pending migrations (done automatically)
php artisan migrate --force
```

---

## ⚡ Performance Optimization

### Already Configured

✅ **OPcache** - Enabled in Docker PHP
✅ **Composer Autoloader** - Optimized with `--optimize-autoloader`
✅ **Config Caching** - `php artisan config:cache`
✅ **Route Caching** - `php artisan route:cache`
✅ **View Caching** - `php artisan view:cache`
✅ **Optimization** - `php artisan optimize`

### Recommended Upgrades

#### 1. Redis for Caching & Sessions

**Why**: File-based cache doesn't scale across multiple instances

```bash
# In Koyeb, add Redis service
# Update environment variables:
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=your-redis-host.koyeb.app
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379
```

#### 2. Database Session Table

**Why**: Better for horizontal scaling

```bash
# Run migration to create sessions table
php artisan session:table
php artisan migrate

# Update .env
SESSION_DRIVER=database
SESSION_CONNECTION=mysql
```

#### 3. Queue Workers for Background Jobs

**Why**: Async processing of emails, reports, etc.

```bash
QUEUE_CONNECTION=database

# In Koyeb, add a Worker instance:
# Command: php artisan queue:work --tries=3 --timeout=90
```

#### 4. CDN for Static Assets

**Why**: Faster asset delivery worldwide

```bash
# Use AWS CloudFront, Cloudflare, or BunnyCDN
ASSET_URL=https://cdn.ecole.mr
```

---

## 📊 Monitoring & Logging

### Koyeb Built-in Monitoring

1. **Application Logs**:
   - Dashboard → Your App → Logs
   - Real-time log streaming
   - Filter by severity

2. **Metrics**:
   - CPU usage
   - Memory usage
   - HTTP requests
   - Response times

### Recommended: Sentry Error Tracking

```bash
# Install Sentry SDK
composer require sentry/sentry-laravel

# Configure in .env
SENTRY_LARAVEL_DSN=https://your-key@sentry.io/project-id
SENTRY_TRACES_SAMPLE_RATE=0.2

# Publish config
php artisan vendor:publish --provider="Sentry\Laravel\ServiceProvider"
```

### Log Channels

Current configuration sends logs to `stderr` (captured by Koyeb):

```bash
LOG_CHANNEL=stderr
LOG_LEVEL=error  # Only log errors in production
```

**Available Channels**:
- `stderr` - Koyeb captures these
- `stack` - Multiple channels
- `daily` - Rotate daily log files
- `slack` - Send critical errors to Slack
- `syslog` - System logging

---

## 🐛 Troubleshooting

### Common Issues & Solutions

#### 1. 500 Internal Server Error

**Symptoms**: White page, no error message

**Solution**:
```bash
# Check Koyeb logs
# Temporarily enable debug (ONLY for troubleshooting):
APP_DEBUG=true
LOG_LEVEL=debug

# Check logs, find error
# Fix error, then disable debug:
APP_DEBUG=false
LOG_LEVEL=error
```

#### 2. Database Connection Failed

**Check**:
```bash
# Verify credentials in Koyeb environment variables
# Test connection manually:
php artisan tinker
>>> DB::connection()->getPdo();
```

**Common Causes**:
- Wrong DB_HOST, DB_DATABASE, DB_USERNAME, or DB_PASSWORD
- Database server down
- Firewall blocking connection

#### 3. Session/Cookie Issues

**Symptoms**: Can't login, session expires immediately

**Solution**:
```bash
# Ensure HTTPS cookies are configured:
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=.koyeb.app
SESSION_SAME_SITE=lax

# Clear browser cookies and try again
```

#### 4. Mixed Content Warnings

**Symptoms**: Browser blocks HTTP resources on HTTPS page

**Solution**:
```bash
# Ensure all assets use HTTPS:
APP_URL=https://your-app-name.koyeb.app
ASSET_URL=https://your-app-name.koyeb.app

# In Blade templates, use:
{{ asset('css/style.css') }}  # Not hardcoded http://
```

#### 5. 404 on Routes

**Symptoms**: Routes work locally but 404 in production

**Solution**:
```bash
# Clear route cache:
php artisan route:clear
php artisan route:cache

# Ensure .htaccess is working
# Check Apache mod_rewrite is enabled (already done in Dockerfile)
```

---

## 🔄 Deployment Workflow

### Automated Deployment (Current Setup)

✅ **Automatic**: Push to GitHub → Koyeb auto-deploys

```bash
# Make changes locally
git add .
git commit -m "Update: description"
git push origin main

# Koyeb automatically:
# 1. Pulls latest code
# 2. Builds Docker image
# 3. Runs entrypoint.sh (migrations, cache, etc.)
# 4. Deploys new version
# 5. Health checks pass → switches traffic
```

### Manual Deployment

```bash
# In Koyeb Dashboard:
# 1. Go to your app
# 2. Click "Redeploy"
# 3. Select "Latest commit" or specific commit
# 4. Click "Deploy"
```

### Rollback Procedure

```bash
# In Koyeb Dashboard:
# 1. Go to Deployments tab
# 2. Find previous successful deployment
# 3. Click "Redeploy"
```

---

## 📞 Support & Maintenance

### Health Check Endpoint

Monitor application health:
```
GET https://your-app-name.koyeb.app/health
```

Response:
```json
{
  "status": "ok",
  "database": "connected",
  "app_version": "1.0.0"
}
```

### Regular Maintenance Tasks

**Daily**:
- [x] Check Koyeb logs for errors
- [x] Monitor response times

**Weekly**:
- [x] Review application metrics
- [x] Check database size/performance
- [x] Test backup restoration

**Monthly**:
- [x] Update dependencies (`composer update`)
- [x] Review security advisories
- [x] Rotate credentials if needed
- [x] Performance optimization review

---

## 🎓 Additional Resources

- **Laravel Deployment**: https://laravel.com/docs/deployment
- **Koyeb Documentation**: https://www.koyeb.com/docs
- **Clever Cloud MySQL**: https://www.clever-cloud.com/doc/mysql/
- **Security Best Practices**: https://laravel.com/docs/security

---

## 📝 Change Log

| Date | Version | Changes |
|------|---------|---------|
| 2025-10-10 | 1.0.0 | Initial production deployment |
|  |  | - Docker containerization |
|  |  | - Koyeb deployment configured |
|  |  | - Clever Cloud MySQL integration |
|  |  | - HTTPS enabled |
|  |  | - 27 migrations completed |

---

## ✅ Production Checklist

Before going fully live, verify:

- [ ] APP_DEBUG=false in Koyeb environment
- [ ] APP_ENV=production in Koyeb environment
- [ ] Strong APP_KEY set (32+ characters)
- [ ] Database credentials secure
- [ ] HTTPS working (green padlock in browser)
- [ ] All migrations completed successfully
- [ ] Email sending configured and tested
- [ ] Backup strategy implemented
- [ ] Error monitoring configured (Sentry recommended)
- [ ] Performance tested under load
- [ ] Session security configured (secure cookies)
- [ ] Trusted proxies configured
- [ ] Log rotation configured
- [ ] Health check endpoint responding
- [ ] Custom domain configured (if applicable)
- [ ] DNS records updated (if custom domain)

**Status**: ✅ Application successfully deployed and operational!

**Live URL**: https://your-app-name.koyeb.app/

---

*Last Updated: October 10, 2025*
*Maintained by: Development Team*
