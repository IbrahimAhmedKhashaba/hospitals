# 🏥 Hospital Management System – Laravel 11

A comprehensive web application to streamline hospital operations including appointments, patient records, and administration. Built with Laravel 11, the system is modular, multilingual, and secure with role-based access.

---

## 🚀 Features

- Manage Patients, Appointments, and Doctors
- Admin Dashboard with Analytics
- Multi-language Support (Blade + DB)
- Role-Based Access Control (Gates & Policies)
- Notifications System
- Repository Design Pattern for Code Organization
- Livewire for Interactive Components
- Debugging Tools with Laravel Debugbar

---

## 🛠️ Built With

- **Laravel 11**
- **PHP 8+**
- **MySQL**
- **Livewire**
- **Blade**
- **Bootstrap**
- **Git & GitHub**

---

## 📦 Installation

```bash
git clone https://github.com/IbrahimAhmedKhashaba/hospitals.git
cd hospitals
composer install
cp .env.example .env
php artisan key:generate
# Set your DB credentials in .env
php artisan migrate
php artisan serve
