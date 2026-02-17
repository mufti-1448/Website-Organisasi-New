# 🚀 Railway Deployment Guide

Panduan lengkap untuk deploy **Website Organisasi** ke Railway.

---

## 📋 Prerequisites

Pastikan Anda sudah memiliki:

1. ✅ **GitHub Account** - Repository sudah di-push ke GitHub
2. ✅ **Railway Account** - Daftar di https://railway.app (gratis trial)
3. ✅ **Project siap** - Semua file sudah commit

---

## 🎯 Step-by-Step Deployment

### Step 1: Login ke Railway

1. Buka https://railway.app
2. Click "Login" → Pilih "Login with GitHub"
3. Authorize Railway untuk akses GitHub

### Step 2: Create New Project

1. Click "Create New Project"
2. Pilih "Deploy from GitHub repo"
3. Authorize & select repository `Website-Organisasi-New`

### Step 3: Add Services

Railway akan auto-detect dan create services. Jika belum:

#### Service 1: Web (Laravel)
- Sudah auto-detect dari Procfile
- Domain akan di-generate otomatis
- Build: `composer install && npm install && npm run build`
- Start: `vendor/bin/heroku-php-apache2 public/`

#### Service 2: PostgreSQL Database
- Click "Add Service" → "Database" → "PostgreSQL"
- Railway auto-setup semua konfigurasi
- Environment variables akan di-inject otomatis

### Step 4: Configure Environment Variables

Railway sudah auto-generate `DATABASE_URL`, tapi perlu set:

1. Click project → Variables
2. Pastikan ada:
   ```
   APP_NAME = Website-Organisasi
   APP_ENV = production
   APP_DEBUG = false
   APP_KEY = (kosong dulu, akan generate saat deploy)
   APP_URL = https://your-project.railway.app
   DB_CONNECTION = postgres
   DB_URL = (auto dari PostgreSQL)
   ```

3. Railway akan provide:
   - `DATABASE_URL` (otomatis dari PostgreSQL)

### Step 5: Enable APP_KEY Generation

Railway auto-run release command di Procfile:

```
release: php artisan migrate --force && php artisan db:seed --class=AdminUserSeeder --force
```

Ini akan:
- ✅ Generate `APP_KEY` jika belum ada
- ✅ Run migrations
- ✅ Seed admin user

### Step 6: Deploy!

1. Click "Deploy"
2. Railway akan:
   - Pull repo dari GitHub
   - Install dependencies (PHP + Node)
   - Build assets (Vite)
   - Run migrations
   - Start server

3. Tunggu sampai "✓ Healthy" di Railway dashboard

### Step 7: Access Website

- URL akan di-provide oleh Railway
- Format: `https://yourproject-production.up.railway.app`
- Login admin: Email & password dari seeder

---

## 🔑 Default Admin Credentials

Seeder akan create admin user dengan:
- **Email**: Lihat di `database/seeders/AdminUserSeeder.php`
- **Password**: Lihat di `database/seeders/AdminUserSeeder.php`

Edit seeder jika ingin custom credentials!

---

## 📊 Database Migrations

Railway run otomatis:
```bash
php artisan migrate --force
```

Jika perlu re-seed:
1. Railway Dashboard → Web service → Logs
2. Run manual:
   ```bash
   php artisan db:seed --class=AdminUserSeeder --force
   ```

---

## 🔗 Connect Domain Custom

Jika punya domain sendiri:

1. Railway Dashboard → project → Settings
2. Click "Custom Domain"
3. Input domain Anda (ex: `website.sekolah.com`)
4. Update DNS records sesuai instruksi Railway
5. Wait 24 jam untuk DNS propagation

---

## 📱 Troubleshooting

### Build Failed
- Check logs di Railway Dashboard
- Pastikan `Procfile` ada di root project
- Verify `.env.example` memiliki semua variables

### Database Error
- Pastikan PostgreSQL service terhubung
- Check `DB_URL` variable di Railway
- Run migrations manual di Railway shell

### Assets Not Loading
```bash
# Railway shell: run this
php artisan storage:link
npm run build
```

### Clear Cache
```bash
# Di Railway shell
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🚨 Important Notes

⚠️ **Production Mode**:
- `APP_DEBUG=false` untuk production
- `APP_ENV=production`
- Logging set ke `info` level

⚠️ **Session Handling**:
- Session driver: `database`
- Railway provide database, jadi semua OK

⚠️ **Costs**:
- Trial gratis 5 GB
- Setelah itu: $5/GB/bulan
- Database: included dalam trial

---

## ✅ Verification Checklist

Sebelum deploy, pastikan:

- [ ] Repository sudah di-push ke GitHub
- [ ] `Procfile` ada di root
- [ ] `.env.example` sudah update
- [ ] `composer.json` & `package.json` valid
- [ ] `database/seeders/AdminUserSeeder.php` ada
- [ ] All migrations di `database/migrations/` OK
- [ ] `public/` folder ada
- [ ] `resources/views/` ada

---

## 🎓 Learn More

- Railway Docs: https://docs.railway.app/
- Laravel Deployment: https://laravel.com/docs/12/deployment
- PostgreSQL on Railway: https://docs.railway.app/databases/postgresql

---

**Happy Deploying! 🚀**
