# 📝 PHP Secure Notes App

A simple and secure Note-Taking web application built with raw PHP and MySQL. It features a complete user authentication system and ensures that each user has a private dashboard to manage their own notes.

## ✨ Features
* **User Authentication:** Secure Registration and Login system.
* **Password Hashing:** Passwords are encrypted in the database using `password_hash()`.
* **Data Isolation:** Each user can only view, add, and delete their own notes.
* **Security:** * Protected against SQL Injection using **PDO Prepared Statements**.
  * Protected against XSS (Cross-Site Scripting) using input sanitization (`htmlspecialchars`).
* **CRUD Operations:** Users can Create, Read, and Delete notes.

## 🛠️ Technologies Used
* **Backend:** PHP (PDO)
* **Database:** MySQL
* **Frontend:** HTML5, CSS (Inline styling for simplicity)
* **Server Environment:** XAMPP (Apache & MySQL)

## 🚀 How to Run the Project Locally

Follow these steps to test the project on your machine:

### 1. Prerequisites
* Install [XAMPP](https://www.apachefriends.org/index.html) (or any local server like MAMP/WAMP).
* Ensure **Apache** and **MySQL** are running.

### 2. Setup the Files
* Navigate to your XAMPP `htdocs` folder (usually `C:\xampp\htdocs`).
* Create a folder named `notes_app` and place all project files inside it.

### 3. Database Setup
* Open your browser and go to `http://localhost/phpmyadmin/`.
* Create a new database named `notes_app`.
* Go to the **SQL** tab, copy the contents of `setup.sql`, and click **Go** to create the required tables (`users` and `notes`).

### 4. Run the App
* Open your browser and navigate to: `http://localhost/notes_app/register.php`
* Create a new account, log in, and start adding your notes!

---
*Created as a practical project for learning PHP & SQL Security.*
