# MediLink API - Clinic Management System

REST API for managing Partners, Clinics, and Doctors with role-based access control.

## 🎯 Features

- **Authentication**: Laravel Sanctum token-based auth
- **Role-Based Access**: partner_admin, clinic_admin, doctor
- **Large Dataset**: Optimized for 50,000+ records
- **API Pagination**: 50 records per page
- **Filtering**: By city, partner_id, status, specialty

## 🏗️ Models & Relationships

- **Partners** → Clinics → Doctors
- **Entities** (Polymorphic users table)

## 🔑 User Roles

- **Partner Admin**: Access to all clinics/doctors under their partner
- **Clinic Admin**: Access only to their clinic and its doctors  
- **Doctor**: Access only to their own data

## 📊 API Endpoints

### Authentication
- `POST /api/login` - Login
- `POST /api/logout` - Logout

### Partners
- `GET /api/partners` - List partners (paginated)
- `GET /api/partners/{id}` - Partner details with clinics & doctors

### Clinics
- `GET /api/clinics` - List clinics (filter by city, partner_id)

### Doctors
- `GET /api/doctors` - List doctors (filter by status, specialty)
- `POST /api/doctors` - Create doctor
- `PUT /api/doctors/{id}` - Update doctor status

## 👥 Test Users

**Partner Admin:**
- Email: `partner_admin_4@medilink.com`
- Password: `password123`

**Clinic Admin:**
- Email: `clinic_admin_1@medilink.com`
- Password: `password123`

## 🚀 Quick Start

1. Clone & install dependencies
2. Setup database and run: `php artisan migrate --seed`
3. Start server: `php artisan serve`
4. Use Postman collection for testing

## 💾 Data Seeding

- 5,000 Partners
- 15,000 Clinics  
- 30,000 Doctors
- 50,000+ Entities