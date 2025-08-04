# 📘 Laravel Project Documentation & Feature Reference

Dokumen ini berfungsi sebagai peta fitur penting dalam proyek Laravel ini. Gunakan daftar di bawah untuk menemukan penggunaan fitur Laravel seperti **Helpers**, **Traits**, **Middleware**, dan lainnya — lengkap dengan referensi ke dokumentasi resmi.

---

## 📂 Struktur Umum

- `app/` — Berisi semua logika aplikasi (Controllers, Models, Traits, dll.)
- `routes/` — File routing (`web.php`, `api.php`, dll.)
- `resources/views/` — Blade templates (UI)
- `config/` — Konfigurasi aplikasi
- `database/migrations/` — Struktur tabel database

---

## 🧰 Laravel Helpers

📄 **Contoh File**:  
- `app/Helpers/GeneralHelper.php`  
- `app/Http/Controllers/BukuController.php`

🔗 Dokumentasi: [Laravel Helpers](https://laravel.com/docs/10.x/helpers)

📝 Penjelasan:  
Helper umum digunakan untuk fungsi-fungsi global seperti format tanggal, generate kode unik, dll.

---

## 🧬 Traits

📄 **Contoh File**:  
- `app/Traits/ResponseFormatter.php`  
- `app/Http/Controllers/ApiController.php` (menggunakan trait tersebut)

🔗 Dokumentasi: [OOP PHP Traits](https://www.php.net/manual/en/language.oop5.traits.php)

📝 Penjelasan:  
Trait digunakan untuk menyimpan fungsi reusable yang bisa digunakan di berbagai class.

---

## 🔐 Middleware

📄 **Contoh File**:  
- `app/Http/Middleware/AdminMiddleware.php`  
- Terdaftar di: `app/Http/Kernel.php`

🔗 Dokumentasi: [Laravel Middleware](https://laravel.com/docs/10.x/middleware)

📝 Penjelasan:  
Digunakan untuk mengecek hak akses (role admin, user, dll.) saat mengakses route tertentu.

---

## 📦 Request Validation (FormRequest)

📄 **Contoh File**:  
- `app/Http/Requests/StoreBukuRequest.php`  
- Digunakan di `BukuController@store`

🔗 Dokumentasi: [Form Request Validation](https://laravel.com/docs/10.x/validation#form-request-validation)

📝 Penjelasan:  
Digunakan untuk memvalidasi input form dengan lebih rapi dan terpisah dari controller.

---

## 📄 Blade Layout & Component

📄 **Contoh File**:  
- `resources/views/layouts/app.blade.php`  
- `resources/views/components/alert.blade.php`

🔗 Dokumentasi: [Blade Templates](https://laravel.com/docs/10.x/blade)

📝 Penjelasan:  
Digunakan untuk layouting UI dan komponen UI yang bisa digunakan ulang.

---

## 📁 Storage & File Upload

📄 **Contoh File**:  
- `app/Http/Controllers/UploadController.php`  
- Konfigurasi: `config/filesystems.php`

🔗 Dokumentasi: [Laravel Filesystem](https://laravel.com/docs/10.x/filesystem)

📝 Penjelasan:  
Digunakan untuk menyimpan file di local/public/cloud storage.

---

## 🔄 Eloquent Relationships

📄 **Contoh File**:  
- `app/Models/Buku.php` → relasi `hasMany(Peminjaman::class)`  
- `app/Models/User.php` → relasi `belongsTo(Role::class)`

🔗 Dokumentasi: [Eloquent Relationships](https://laravel.com/docs/10.x/eloquent-relationships)

📝 Penjelasan:  
Menjelaskan hubungan antar model (One To Many, Many To Many, dst.)

---

## 🔧 Seeder & Factory

📄 **Contoh File**:  
- `database/seeders/UserSeeder.php`  
- `database/factories/UserFactory.php`

🔗 Dokumentasi: [Database Seeding](https://laravel.com/docs/10.x/seeding)

📝 Penjelasan:  
Untuk generate data dummy/testing ke database.

---

## 🔄 Route Resource

📄 **Contoh File**:  
- `routes/web.php` → `Route::resource('buku', BukuController::class);`

🔗 Dokumentasi: [Resource Controllers](https://laravel.com/docs/10.x/controllers#resource-controllers)

📝 Penjelasan:  
Mendaftarkan route CRUD secara otomatis berdasarkan konvensi nama method (`index`, `create`, `store`, dst.)

---

## ✅ Authorization & Gate (Jika digunakan)

📄 **Contoh File**:  
- `app/Policies/BukuPolicy.php`  
- Register di `AuthServiceProvider.php`

🔗 Dokumentasi: [Authorization](https://laravel.com/docs/10.x/authorization)

📝 Penjelasan:  
Digunakan untuk otorisasi tindakan per user berdasarkan policy.

---

## 📌 Tips Tambahan

🧭 Untuk mencari file berdasarkan fitur, gunakan fitur search editor:  
- **VSCode**: `Ctrl + P` atau `Ctrl + Shift + F`  
- **Cari trait/helper**: Ketik nama trait/helper atau `use TraitName`

🧼 Pastikan semua helper dan trait disusun dengan rapi dalam folder `Helpers/` dan `Traits/` untuk navigasi mudah.

---

## 📚 Referensi Tambahan

- [Laravel Official Docs](https://laravel.com/docs)
- [Laravel Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Laravel_Cheat_Sheet.html)
- [PHP Manual](https://www.php.net/manual/en/index.php)

---

> Dokumen ini dapat kamu update seiring bertambahnya fitur baru di dalam proyek.

