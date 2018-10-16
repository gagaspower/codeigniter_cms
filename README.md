# codeigniter_cms
Project website sederhana dengan codeigniter

cara menjalankan CMS ini :
1. Buat nama database baru di MySQL
2. Buka file database di folder database/xxxxxxxx.sql dan import ke dalam database yang sudah dibuat.
3. Ubah koneksi database yang berada di application/config/database.php
4. Save dan jalankan di browser.

Jika terdapat error saat pertama kali menjalankan maka Non-aktifkan hooks 

application/config/config.php

$config['enable_hooks'] = TRUE;

ke 

$config['enable_hooks'] = FALSE;
