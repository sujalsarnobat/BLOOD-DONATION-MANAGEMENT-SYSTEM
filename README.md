Blood Donation Management System (BBDMS)
A web‑based Blood Donation Management System built with PHP and MySQL. It allows users to register as blood donors, search donors by blood group and city, submit queries, and provides an admin dashboard to manage donors, blood groups, CMS pages, contact queries, and activity logs.

✨ Features
Public Module
Donor registration with details like name, blood group, age, city, contact info.

Search donors by blood group and city (only active donors).

“Contact Us” form for general queries.

Informational pages like “About Us” and “Why Become a Donor”.

Admin Module
Secure admin login and session management.

Dashboard with key stats (total donors, blood groups, queries, logs, etc.).

Manage donors (view, hide/show using status, delete).

Manage blood groups (add / delete).

Manage contact queries (view, mark as read, delete).

Manage CMS pages (About Us, Why Become Donor) using a rich‑text editor.

View donor activity logs (added / updated / deleted) generated automatically via database triggers.

Database / DBMS Concepts
Normalized relational schema with foreign keys.

Stored procedures:

AddDonor – insert a new donor.

UpdateDonorStatus – hide/show a donor.

SearchDonors – search donors by blood group and city.

Functions:

GetDonorName(donorId)

CountByBloodGroup(bloodGroupName)

Triggers on tblblooddonars:

after_donor_insert

after_donor_update

after_donor_delete

Example nested, join and aggregate queries for reporting.

🧱 Tech Stack
Frontend: HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, DataTables

Backend: PHP (PDO)

Database: MySQL

Server: Apache (XAMPP / WAMP / LAMP)

📂 Database Design
Main tables:

admin(id, UserName, Password, updationDate)

tblbloodgroup(id, BloodGroup, PostingDate)

tblblooddonars(id, FullName, MobileNumber, EmailId, Gender, Age, BloodGroup, Address, Message, PostingDate, status)

tbldependents(id, DonorID, DependentName, Relationship, Age)

tblcontactusinfo(id, Address, EmailId, ContactNo)

tblcontactusquery(id, name, EmailId, ContactNumber, Message, PostingDate, status)

tblpages(id, PageName, type, detail)

donor_logs(log_id, donor_id, action, timestamp)

The full schema, sample data, procedures, functions and triggers are in sql/blood_donation.sql.

🚀 Getting Started
Prerequisites
XAMPP / WAMP / LAMP stack installed.

PHP 7.4+ and MySQL 5.7+ (or compatible).

Installation
Clone the repository:

bash
git clone https://github.com/<your-username>/<your-repo-name>.git
Move the project into your server directory (e.g. C:\xampp\htdocs\BBDMS).

Start Apache and MySQL from your local server control panel.

Create the database:

Open http://localhost/phpmyadmin

Create a database named blood_donation

Import sql/blood_donation.sql into this database.

Configure DB connection in includes/config.php if needed (host, username, password).

Access the app:

Public site: http://localhost/BBDMS/

Admin panel: http://localhost/BBDMS/admin/

Default admin credentials (change in DB after first login):

text
Username: nandini
Password: nandini1012
🖼️ Screenshots
(Add images from your screenshots/ folder with captions, e.g.)

Home page

Become a Donor page

Search Donors results

Admin login

Admin dashboard

Manage Donors

Manage Blood Groups

Manage Contact Queries

Manage Pages (CMS)

Donor Activity Logs

📚 Project Structure
text
BBDMS/
├─ admin/              # admin-side PHP pages
├─ includes/           # config and common include files
├─ css/, js/           # static assets
├─ sql/blood_donation.sql
├─ index.php           # public home
└─ README.md
✅ Learning Outcomes
This project demonstrates:

Complete DBMS mini‑project lifecycle (ER model → schema → SQL → UI).

Use of stored procedures, functions, and triggers in a real application.

Secure PHP CRUD operations with prepared statements (PDO).

Integration of a relational database with a modern, responsive frontend.

📄 License
You can add your preferred license here, for example:

This project is licensed under the MIT License – see the LICENSE file for details.

