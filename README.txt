TUGAS PRAKTIK DATA JSON API

Nama database:
data_api

Isi folder:
- index.html      : halaman tabel + Add/Edit/Hapus
- koneksi.php     : koneksi MySQL
- data_json.php   : output database dalam format JSON
- users.php       : REST API GET/POST/PUT/DELETE
- database.sql    : struktur dan data database

CARA INSTALASI:
1. Jalankan XAMPP Apache dan MySQL.
2. Salin folder api ke C:\xampp\htdocs\
3. Buka http://localhost/phpmyadmin
4. Import database.sql.
5. Buka http://localhost/api/index.html

API:
GET    http://localhost/api/users.php
GET    http://localhost/api/data_json.php
POST   http://localhost/api/users.php
PUT    http://localhost/api/users.php
DELETE http://localhost/api/users.php

Fitur:
- Menampilkan data users
- Tambah data
- Edit data
- Hapus data

Catatan:
Pastikan Apache dan MySQL aktif sebelum menjalankan aplikasi.
