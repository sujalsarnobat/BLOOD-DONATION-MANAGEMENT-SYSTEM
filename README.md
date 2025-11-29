# 🩸 Blood Donation Management System (BBDMS)

A complete **Web-based Blood Donation Management System** built using **PHP and MySQL**.  
The system enables donors to register, users to search based on blood group & city, and provides an **admin dashboard** to manage donors, queries, pages, and logs.

---

## 🚀 Features

### 👥 Public Module
- Donor registration (name, age, contact, blood group, address).
- Search donors by **blood group + city** (active donors only).
- Contact form for public queries.
- Content pages: **About Us, Why Become a Donor**.

---

### 🔐 Admin Module
- Secure admin login (session-based authentication).
- Dashboard showing:
  - Total donors
  - Blood groups count
  - Messages
  - Activity logs
- Manage:
  - 🩸 Donors (activate/deactivate, delete)
  - 🧬 Blood groups (add/delete)
  - 📩 Contact queries (view, mark read, delete)
  - 📄 CMS pages (rich-text editor support)
  - 🔍 Automatic donor activity logs (added/updated/deleted)

---

## 🛢️ Database & DBMS Concepts

✔ Normalized relational schema  
✔ Foreign keys  
✔ Stored procedures  
✔ Functions  
✔ Triggers  
✔ Joins, nested queries & aggregates  

### Stored Procedures:
- `AddDonor`
- `UpdateDonorStatus`
- `SearchDonors`

### SQL Functions:
- `GetDonorName(donorId)`
- `CountByBloodGroup(bloodGroup)`

### Triggers:
- `after_donor_insert`  
- `after_donor_update`  
- `after_donor_delete`

---

## 🧱 Tech Stack

| Layer | Technologies |
|-------|-------------|
| Frontend | HTML5, CSS3, Bootstrap 5, jQuery, JavaScript, DataTables |
| Backend | PHP (PDO) |
| Database | MySQL |
| Server | Apache (XAMPP/WAMP/LAMP) |

---

## 🗄️ Database Schema Overview

| Table | Purpose |
|-------|---------|
| `admin` | Admin login credentials |
| `tblbloodgroup` | Available blood groups |
| `tblblooddonars` | Donor details |
| `tbldependents` | Donor’s family details |
| `tblcontactusinfo` | Website contact info |
| `tblcontactusquery` | User-submitted messages |
| `tblpages` | CMS page content |
| `donor_logs` | Tracks changes via triggers |

👉 Full schema available in: `sql/blood_donation.sql`

---

## 🧪 Getting Started

### 📌 Prerequisites
- Installed: **XAMPP / WAMP / LAMP**
- PHP **7.4 or later**
- MySQL **5.7 or later**

---

### 📥 Installation

#### 1️⃣ Clone the repository

```sh
git clone https://github.com/<your-username>/BLOOD-DONATION-MANAGEMENT-SYSTEM.git

#### 2️⃣ Move project to server directory:
C:\xampp\htdocs\BBDMS

3️⃣ Import database

Open: http://localhost/phpmyadmin

Create a DB: blood_donation

Import: sql/blood_donation.sql

4️⃣ Configure connection

Check file:

includes/config.php


Update DB host, user, and password (if required).

▶ Run Application
URL	Access
http://localhost/BBDMS/	Public website
http://localhost/BBDMS/admin/	Admin portal
🛂 Default Admin Login
Username	Password
nandini	nandini1012

⚠ Change it after first login for security.

📷 Screenshots

(Add real screenshots to make it more professional)

Home Page

Become a Donor Form

Search Results

Admin Login

Admin Dashboard

Manage Donors

Activity Logs

CMS Editor

📁 Project Structure
BBDMS/
├─ admin/               
├─ includes/           
├─ css/ | js/          
├─ sql/blood_donation.sql
├─ index.php           
└─ README.md           

🎓 Learning Outcomes

This project demonstrates:

🔹 Complete DBMS Mini-project workflow

🔹 SQL functions, triggers & stored procedures

🔹 Secure PHP CRUD with PDO

🔹 Database-driven dynamic web application

🔹 Real-world schema design and server integration

📝 License

This project is open-source under the MIT License.
You are free to modify and use it for academic or personal purposes.
This project is licensed under the MIT License – see the LICENSE file for details.

