
---

# 📘 TECHNICAL.md (DOKUMENTASI DEVELOPER)

```md
# 🧠 Technical Documentation
Website Organisasi Sekolah

---

## 📁 Project Structure

This project follows the standard **Laravel 12** structure to ensure clean architecture and maintainability.

### Key Directories
- `app/`
  - `Http/Controllers/` – Controllers for admin & user
  - `Http/Middleware/` – Role-based access (IsAdmin)
  - `Models/` – Eloquent models
- `routes/` – Web routing (admin & user)
- `resources/views/`
  - `admin/` – Admin interface
  - `user/` – Public interface
- `database/`
  - Migrations
  - Seeders
- `public/` – Assets (CSS, JS, images)
- `storage/` – Logs & cache

---

## 🔐 Authentication Flow (Admin Only)

- Login URL: `/login`
- Authentication handled via `AdminAuthController`
- Uses Laravel Auth system
- Admin is verified using `is_admin` field in `users` table
- Non-admin users are logged out automatically
- Admin routes are protected using `IsAdmin` middleware

Public user routes **do not require authentication**.

---

## 🧑‍💼 Role-Based Access Control

### Roles
- **Admin**
  - Full access to dashboard & CRUD features
- **User (Public)**
  - Read-only access to frontend pages

### Middleware
- `IsAdmin`
  - Checks `Auth::user()->is_admin`
  - Returns 404 if access is unauthorized

---

## 🧩 AdminAuthController Overview

### showLoginForm()
- Displays admin login page

### login(Request $request)
- Validates email & password
- Authenticates user
- Checks admin role
- Redirects admin or denies access

### logout(Request $request)
- Logs user out
- Invalidates session
- Redirects to login page

This controller acts as a **security gate** for admin access.

---

## 🗄️ Database Models & Relationships

### User
- `is_admin` (boolean)
- Used for authentication

### Anggota
- hasMany ProgramKerja
- hasMany Notulen
- hasMany Evaluasi

### ProgramKerja
- belongsTo Anggota
- hasOne Evaluasi
- hasOne Notulen

### Rapat
- hasOne Notulen

### Notulen
- belongsTo Rapat
- belongsTo Anggota
- belongsTo ProgramKerja

### Evaluasi
- belongsTo ProgramKerja
- belongsTo Anggota

Primary keys use **string-based IDs (UUID-style)**.

---

## 🧱 MVC Implementation
- **Model**: Handles data & relationships
- **View**: Blade templates for admin & user
- **Controller**: Business logic & routing control

---

## 📌 Notes
- Designed for UKK & portfolio purposes
- Clean separation between admin & public access
- Easy to extend for future features

