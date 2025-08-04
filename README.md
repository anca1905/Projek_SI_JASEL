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


