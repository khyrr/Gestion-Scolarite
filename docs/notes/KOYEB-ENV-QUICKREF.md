# 🚀 Koyeb Environment Variables - Quick Reference

## Copy-Paste Ready Configuration

### Step 1: Login to Koyeb
1. Go to: https://app.koyeb.com
2. Navigate to your app: `your-app-name`
3. Click: **Settings** → **Environment Variables**

---

## 🔴 CRITICAL - Set These Immediately

### Application Settings
```
APP_NAME=Gestion Scolarité
APP_ENV=production
APP_DEBUG=false
APP_KEY=your-app-key-here
APP_URL=https://your-app-name.koyeb.app
```

### Database (Clever Cloud)
```
DB_CONNECTION=mysql
DB_HOST=your-database-host.com
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

### Security
```
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
TRUSTED_PROXIES=*
```

### Logging
```
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

---

## 🟡 RECOMMENDED - Add for Better Security

### Session Configuration
```
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=.koyeb.app
SESSION_HTTP_ONLY=true
```

### Timezone & Locale
```
APP_TIMEZONE=UTC
APP_LOCALE=fr
APP_FALLBACK_LOCALE=en
```

### Cache
```
CACHE_DRIVER=file
CACHE_PREFIX=gestion_scolarite
```

---

## 🟢 OPTIONAL - Email Configuration

### Gmail SMTP (For password reset, notifications)
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@ecole.mr
MAIL_FROM_NAME=Gestion Scolarité
```

**How to get Gmail App Password:**
1. Google Account → Security → 2-Step Verification (enable it)
2. Search "App passwords" → Create → Select "Mail"
3. Copy the 16-character password
4. Use it as MAIL_PASSWORD

---

## 📋 How to Add in Koyeb

### Method 1: One-by-one
1. Click **"Add variable"**
2. Enter **Key** (e.g., `APP_DEBUG`)
3. Enter **Value** (e.g., `false`)
4. Click **Save**
5. Repeat for all variables

### Method 2: Bulk Import (Faster)
1. Click **"Import from file"**
2. Upload `.env.production` file
3. Review variables
4. Click **Import**

---

## ⚠️ IMPORTANT NOTES

### 🔒 Security Rules
- ✅ **ALWAYS** set `APP_DEBUG=false` in production
- ✅ **NEVER** share your `APP_KEY` publicly
- ✅ **NEVER** commit `.env` files to Git
- ✅ Keep `DB_PASSWORD` secret
- ✅ Use HTTPS URLs (not HTTP)

### 🔄 After Adding Variables
1. Click **"Deploy"** or **"Redeploy"** for changes to take effect
2. Wait for deployment to complete (2-3 minutes)
3. Check logs for any errors
4. Test the application

### ✅ Verification Checklist
After deployment, verify:
- [ ] Can access: https://your-app-name.koyeb.app/
- [ ] No 500 errors
- [ ] Can switch languages (AR/FR/EN)
- [ ] Can search for student transcripts
- [ ] Login page loads correctly
- [ ] HTTPS padlock shows in browser

---

## 🐛 Troubleshooting

### If you see 500 errors:
1. Go to **Logs** tab in Koyeb
2. Look for error messages
3. Common issues:
   - Missing `APP_KEY` → Add it
   - Wrong database credentials → Double-check DB_* variables
   - `APP_DEBUG=true` → Set to `false`

### If database won't connect:
1. Verify all DB_* variables are correct
2. Check Clever Cloud dashboard for database status
3. Test connection in Koyeb logs:
   ```
   Look for: "✅ Database connection successful"
   ```

### If sessions don't work:
1. Ensure `SESSION_SECURE_COOKIE=true`
2. Ensure `APP_URL` uses `https://`
3. Clear browser cookies and try again

---

## 📊 Current Status

**Application**: ✅ Deployed and Running  
**URL**: https://your-app-name.koyeb.app/  
**Database**: ✅ Connected (Clever Cloud MySQL)  
**Migrations**: ✅ 27/27 completed  
**HTTPS**: ✅ Enabled  

---

## 🎯 Quick Actions

### Redeploy Application
```
Koyeb Dashboard → Your App → Redeploy
```

### View Logs
```
Koyeb Dashboard → Your App → Logs → Live tail
```

### Check Health
```
Visit: https://your-app-name.koyeb.app/health
```

### Generate New APP_KEY (if needed)
```bash
# Run locally:
php artisan key:generate --show

# Copy output and update APP_KEY in Koyeb
# Example: base64:NEW_KEY_HERE
```

---

*Quick Reference Card - Keep this handy for deployment!*
