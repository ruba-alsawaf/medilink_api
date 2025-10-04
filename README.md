# MediLink API - Clinic Management System

REST API for managing Partners, Clinics, and Doctors with **role-based access control**.

---

## 🎯 Features

* **Authentication**: Laravel Sanctum token-based auth
* **Role-Based Access**: partner_admin, clinic_admin, doctor
* **High Performance**: optimized for 50,000+ records
* **API Pagination**: 50 records per page
* **Dynamic Filtering**: by city, partner_id, status, specialty

---

## 🏗️ Models & Relationships

* **Partners** → **Clinics** → **Doctors**
* **Entities**: polymorphic users table

---

## 🔑 User Roles

* **Partner Admin**: Access to all clinics and doctors under their partner
* **Clinic Admin**: Access only to their clinic and its doctors
* **Doctor**: Access only to their own data

---

## 📊 API Endpoints

### Authentication

* `POST /api/login` - Login
* `POST /api/logout` - Logout

### Partners

* `GET /api/partners` - List partners (paginated)
* `GET /api/partners/{id}` - Partner details with clinics and doctors

### Clinics

* `GET /api/clinics` - List clinics (filter by city, partner_id)

### Doctors

* `GET /api/doctors` - List doctors (filter by status, specialty)
* `POST /api/doctors` - Create a new doctor
* `PUT /api/doctors/{id}` - Update doctor status

---

## 👥 Test Users

**Partner Admin:**

* Email: `partner_admin_4@medilink.com`
* Password: `password123`

**Clinic Admin:**

* Email: `clinic_admin_1@medilink.com`
* Password: `password123`

---

## 🚀 Quick Start

1. Clone the project and install dependencies:

```bash
git clone https://github.com/ruba-alsawaf/medilink_api.git
cd medilink_api
composer install
cp .env.example .env
php artisan key:generate
```

2. Set up the database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medilink
DB_USERNAME=root
DB_PASSWORD=
```

3. Run migrations and seed the database:

```bash
php artisan migrate --seed
```

4. Start the local server:

```bash
php artisan serve
```

* Server runs at: `http://127.0.0.1:8000`

5. Use the **Postman Collection** to test all APIs

---

## 💾 Data Seeding

* 5,000 Partners
* 15,000 Clinics
* 30,000 Doctors
* 50,000+ Entities

> Note: Seeders and Factories are prepared to generate large test data for testing the APIs directly.

---

If you want, I can also add a **section with example GET/POST requests and JSON responses** so anyone can test the API immediately without guessing parameters.

Do you want me to do that?
