# 📋 Railway Deployment Checklist

Gunakan checklist ini untuk memastikan semuanya siap deploy!

---

## ✅ Code & Repository

- [x] Repository created & initialized
- [ ] All changes committed to GitHub
- [ ] Procfile created ✓
- [ ] .env.example updated for production ✓
- [ ] rails.toml created ✓
- [ ] DEPLOYMENT.md dokumentasi ready ✓

---

## ✅ Dependencies & Configuration

- [x] Laravel 12 framework installed
- [x] Composer dependencies configured
- [x] npm packages configured (Vite, Tailwind)
- [x] PostgreSQL configuration ready in `config/database.php`
- [x] Database migrations created
- [x] Admin seeder ready with credentials

---

## ✅ Database

- [x] Migrations in `database/migrations/`:
  - Users table migration ✓
  - Anggota table migration ✓
  - Rapat table migration ✓
  - ProgramKerja table migration ✓
  - Notulen table migration ✓
  - Evaluasi table migration ✓
  - Role added to users table migration ✓

- [x] Seeders created:
  - AdminUserSeeder with admin account ✓

---

## ✅ Environment Setup

Railway akan provide:
- [x] DATABASE_URL (auto-generated from PostgreSQL service)

Manual set di Railway Dashboard:
- [ ] APP_NAME = Website-Organisasi
- [ ] APP_ENV = production
- [ ] APP_DEBUG = false
- [ ] APP_URL = https://your-app.railway.app (update nanti)
- [ ] DB_CONNECTION = postgres

---

## ✅ Release Commands

Procfile configure untuk:
- [x] Run migrations automatically: `php artisan migrate --force`
- [x] Seed admin user: `php artisan db:seed --class=AdminUserSeeder --force`

---

## ✅ Build & Start Commands

- [x] Build command: Automated via `composer install` & `npm run build`
- [x] Start command: `vendor/bin/heroku-php-apache2 public/`

---

## 🚀 Before Deployment

1. [ ] Push semua changes ke GitHub:
   ```bash
   git add .
   git commit -m "Prepare for Railway deployment"
   git push origin main
   ```

2. [ ] Verify repository is public (jika private, Railway mungkin perlu token)

3. [ ] Create Railway account + connect GitHub

---

## 🎯 Deployment Steps

1. [ ] Login to railway.app
2. [ ] Create new project from GitHub repo
3. [ ] Select `Website-Organisasi-New` repository
4. [ ] Railway auto-detect Procfile ✓
5. [ ] Add PostgreSQL service
6. [ ] Set environment variables in Railway Dashboard
7. [ ] Wait for build & deploy (5-10 menit)
8. [ ] Check logs for any errors
9. [ ] Access URL provided by Railway

---

## ✅ Post-Deployment

- [ ] Verify website loads correctly
- [ ] Test admin login with credentials:
  - Email: `mufti0480@gmail.com`
  - Password: `mufti404`
- [ ] Check database is seeded:
  ```bash
  # Di Railway shell
  php artisan tinker
  >>> User::where('is_admin', true)->get();
  ```
- [ ] Verify migrations ran: `php artisan migrate:status`
- [ ] Check storage link: `php artisan storage:link`

---

## 🆘 If Something Goes Wrong

Check logs di Railway Dashboard → Web Service → Logs tab

Common issues:
- [ ] **Assets not loading**: Run `npm run build` in Railway shell
- [ ] **Database error**: Verify DATABASE_URL variable
- [ ] **Migration failed**: Check `php artisan migrate:status`
- [ ] **Auth issue**: Verify AdminUserSeeder ran

---

## 📱 Useful Commands (di Railway Shell)

```bash
# View migrations status
php artisan migrate:status

# Re-run seeder
php artisan db:seed --class=AdminUserSeeder --force

# Clear cache
php artisan cache:clear

# Check logs
php artisan logs

# Database shell
php artisan tinker
```

---

## ✨ Notes

- Semua data akan di-store di PostgreSQL
- Session disimpan di database (SESSION_DRIVER=database)
- Cache disimpan di database (CACHE_STORE=database)
- Queue menggunakan database (QUEUE_CONNECTION=database)

---

**Status**: 🟢 Ready for deployment ✓

Last updated: 2025-02-17
