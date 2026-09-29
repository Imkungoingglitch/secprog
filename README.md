# IT Helpdesk

Tugas Secure Programming - aplikasi IT Helpdesk menggunakan PHP Native + Apache.

## Fitur
1. Login
2. Register
3. Forgot Password
4. Dashboard
5. All/My Tickets
6. Create Ticket
7. Ticket Detail
8. Edit Ticket
9. Manage Categories
10. Manage Users
11. Profile
12. Change Profile Photo

## Struktur Folder
```
helpdesk/
├── config/        # konfigurasi database
├── auth/          # login, register, logout, forgot password
├── tickets/       # CRUD tiket
├── admin/         # manage users & categories
├── profile/       # profil & foto profil
├── uploads/       # file upload (foto profil)
├── assets/        # css, js, images
├── includes/      # auth helper, header, footer
└── index.php      # dashboard
```

## Requirement
- PHP 8.x
- Apache
- MySQL / MariaDB
