# Sistem Service Elektronik

Selamat datang di repositori Sistem Service Elektronik! Repositori ini berisi kode sumber untuk aplikasi manajemen service elektronik. Aplikasi ini memungkinkan pengguna untuk membuat pesanan service, teknisi untuk mengelola pesanan masuk, dan admin untuk mengelola pengguna, jasa, dan pesanan secara keseluruhan.

## Penjelasan Implementasi Eloquent Relationships

Di dalam proyek ini, saya telah mengimplementasikan berbagai jenis relasi Eloquent untuk mengelola data antar model dengan efisien. Berikut adalah penjelasan mengenai relasi-relasi yang diterapkan beserta lokasi kode implementasinya:

| 🔢 No | 💡 Jenis Relasi  | 📄 Model Terkait | 🔗 Definisi Relasi                                                                       | 🧑‍💻 Lokasi Kode                                                             | 📌 Keterangan                                              |
| ----- | ---------------- | ---------------- | ---------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------- | ---------------------------------------------------------- |
| 1     | **One-to-Many**  | User → Order     | `User::hasMany(Order::class)` <br> `Order::belongsTo(User::class)`                       | `User.php` (orders)<br>`Order.php` (user)                                     | User (pelanggan) bisa punya banyak pesanan                 |
|       |                  | Service → Order  | `Service::hasMany(Order::class)` <br> `Order::belongsTo(Service::class)`                 | `Service.php` (orders)<br>`Order.php` (service)                               | Satu jasa bisa dipesan banyak kali                         |
|       |                  | Teknisi → Order  | `Technician::hasMany(Order::class)` <br> `Order::belongsTo(Technician::class)`           | `Technician.php` (orders)<br>`Order.php` (technician)                         | Teknisi bisa menangani banyak pesanan                      |
|       |                  | —                | —                                                                                        | `RiwayatPesananController.php` (index) <br> `riwayat_pesanan/index.blade.php` | Menampilkan riwayat & detail pesanan                       |
| 2     | **Many-to-Many** | Order ↔ Service  | `Order::belongsToMany(Service::class)` <br> `Service::belongsToMany(Order::class)`       | `Order.php` (services)<br>`Service.php` (orders)                              | Banyak jasa bisa ditautkan ke satu pesanan, dan sebaliknya |
|       |                  | Order ↔ Teknisi  | `Order::belongsToMany(Technician::class)` <br> `Technician::belongsToMany(Order::class)` | `Order.php`, `Technician.php`                                                 | Satu pesanan bisa ditangani oleh banyak teknisi            |
|       |                  | —                | —                                                                                        | `OrderController.php` (store/update) <br> `order/show.blade.php`              | Input & tampilkan banyak jasa pada pesanan                 |
| 3     | **One-to-One**   | User ↔ Profile   | `User::hasOne(Profile::class)` <br> `Profile::belongsTo(User::class)`                    | `User.php` (profile)<br>`Profile.php` (user)                                  | Satu user memiliki satu data profil tambahan               |
|       |                  | —                | —                                                                                        | `ProfileController.php` (show/edit) <br> `user/profile.blade.php`             | Tampilkan dan ubah profil pengguna                         |


### 1. Relasi One-to-Many (Satu-ke-Banyak)

Relasi ini digunakan ketika satu model memiliki banyak catatan terkait di model lain, tetapi catatan terkait tersebut hanya dimiliki oleh satu model pertama.

* **Contoh Penerapan:**
    * **User (Pelanggan) memiliki banyak Pesanan (Order):** Setiap pelanggan dapat membuat banyak pesanan service, tetapi setiap pesanan hanya dimiliki oleh satu pelanggan.
    * **Service (Jasa) memiliki banyak Pesanan (Order):** Jika sebuah pesanan hanya bisa terkait dengan satu jenis jasa, maka satu jenis jasa bisa dipesan berkali-kali. (Namun, jika satu pesanan bisa memiliki banyak jasa, ini akan menjadi Many-to-Many).
    * **Teknisi memiliki banyak Pesanan (Order):** Seorang teknisi dapat ditugaskan untuk banyak pesanan.

* **Lokasi Kode:**

    * **Definisi Relasi:**
        * `User` Model: `hasMany(Order::class)`
            * [Link ke `app/Models/User.php` - method `orders()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/User.php#LXX)
        * `Order` Model: `belongsTo(User::class)` dan `belongsTo(Service::class)`
            * [Link ke `app/Models/Order.php` - method `user()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Order.php#LXX)
            * [Link ke `app/Models/Order.php` - method `service()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Order.php#LXX)
        * `Service` Model: `hasMany(Order::class)` (jika satu pesanan hanya satu jasa)
            * [Link ke `app/Models/Service.php` - method `orders()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Service.php#LXX)

    * **Penggunaan (Controller/View):**
        * Menampilkan riwayat pesanan pelanggan (`RiwayatPesananController`): Mengambil semua pesanan untuk user yang sedang login.
            * [Link ke `app/Http/Controllers/Pelanggan/RiwayatPesananController.php` - method `index()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Http/Controllers/Pelanggan/RiwayatPesananController.php#LXX)
        * Menampilkan detail pesanan (Admin/Teknisi Controller): Mengambil data user yang membuat pesanan.
            * [Link ke `resources/views/pelanggan/riwayat_pesanan/index.blade.php` - Loop `$orders` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/resources/views/pelanggan/riwayat_pesanan/index.blade.php#LXX)

### 2. Relasi Many-to-Many (Banyak-ke-Banyak)

Relasi ini digunakan ketika banyak catatan di satu model dapat dikaitkan dengan banyak catatan di model lain. Relasi ini biasanya memerlukan tabel pivot (tabel perantara).

* **Contoh Penerapan:**
    * **Pesanan (Order) memiliki banyak Jasa (Service):** Satu pesanan service mungkin melibatkan lebih dari satu jenis jasa (misalnya, perbaikan AC dan pembersihan). Sebaliknya, satu jenis jasa dapat menjadi bagian dari banyak pesanan yang berbeda.
    * **Pesanan (Order) memiliki banyak Teknisi:** Satu pesanan mungkin ditangani oleh tim teknisi, dan seorang teknisi dapat terlibat dalam banyak pesanan.

* **Lokasi Kode:**

    * **Definisi Relasi:**
        * `Order` Model: `belongsToMany(Service::class)` (melalui tabel pivot `order_service`)
            * [Link ke `app/Models/Order.php` - method `services()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Order.php#LXX)
        * `Service` Model: `belongsToMany(Order::class)` (melalui tabel pivot `order_service`)
            * [Link ke `app/Models/Service.php` - method `orders()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Service.php#LXX)

    * **Penggunaan (Controller/View):**
        * Saat membuat atau mengedit pesanan: Menyimpan entri ke tabel pivot.
            * [Link ke `app/Http/Controllers/OrderController.php` - method `store()` atau `update()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Http/Controllers/OrderController.php#LXX)
        * Menampilkan detail pesanan: Mengambil semua jasa yang terkait dengan pesanan tersebut.
            * [Link ke `resources/views/order/show.blade.php` - Menampilkan daftar jasa dalam pesanan (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/resources/views/order/show.blade.php#LXX)

### 3. Relasi One-to-One (Satu-ke-Satu)

Relasi ini digunakan ketika satu model dikaitkan dengan tepat satu catatan di model lain.

* **Contoh Penerapan:**
    * **User memiliki satu Profil (misalnya, profil alamat detail):** Setiap pengguna memiliki satu set detail profil tambahan.

* **Lokasi Kode:**

    * **Definisi Relasi:**
        * `User` Model: `hasOne(Profile::class)`
            * [Link ke `app/Models/User.php` - method `profile()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/User.php#LXX)
        * `Profile` Model: `belongsTo(User::class)`
            * [Link ke `app/Models/Profile.php` - method `user()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Models/Profile.php#LXX)

    * **Penggunaan (Controller/View):**
        * Mengambil dan menampilkan profil pengguna.
            * [Link ke `app/Http/Controllers/ProfileController.php` - method `show()` atau `edit()` (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/app/Http/Controllers/ProfileController.php#LXX)
        * Form untuk mengedit profil pengguna.
            * [Link ke `resources/views/user/profile.blade.php` - Form profil (Contoh)](https://github.com/USERNAME/REPO_NAME/blob/main/resources/views/user/profile.blade.php#LXX)
