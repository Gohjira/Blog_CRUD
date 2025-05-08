# Blog CRUD Application

A simple blog application that demonstrates the basic functionality of Create, Read, Update, Delete (CRUD) operations using PHP and MySQL. This project allows users to manage blog posts with a simple interface, including features like adding new posts, editing existing ones, deleting posts, and viewing them.

---

## Table of Contents

1. Project Description  
2. Objectives  
3. Tools and Technologies  
4. Features  
5. Folder Structure  
6. Database Structure  
7. Installation Steps  
8. Usage Guide  
9. Future Enhancements  
10. Author  

---

## Project Description

This web application demonstrates the basic functionality of CRUD operations using PHP and MySQL. The system allows users to:

- Add new blog posts  
- View the list of blog posts  
- Edit and update existing posts  
- Delete posts from the database  

The front-end is designed with HTML and CSS for a clean and responsive user interface.

---

## Objectives

- Understand how to perform CRUD operations in a web application  
- Learn how to interact with a MySQL database using PHP  
- Build a responsive and user-friendly interface using HTML and CSS  
- Develop a simple and structured PHP project that can be easily maintained and extended  

---

## Tools and Technologies

- PHP  
- MySQL  
- XAMPP  
- HTML5 and CSS3  

---

## Features

### CRUD Operations:

- **Create**: Add new blog posts to the database  
- **Read**: View a list of existing blog posts  
- **Update**: Modify and update the content of existing posts  
- **Delete**: Remove posts from the database  

---

## Folder Structure

```

blog\_crud/
├── db.php         (Database connection file)
├── index.php      (Main page displaying blog posts)
├── add.php        (Form for adding blog posts)
├── edit.php       (Form for editing blog posts)
├── delete.php     (Handles deletion of posts)
├── style.css      (Stylesheet)
└── crud\_db.sql    (SQL file to create the database/table)

````

---

## Database Structure

**Database Name**: `blog_db`  
**Table Name**: `posts`

Fields:
- `id`: INT, Primary Key, Auto Increment  
- `title`: VARCHAR(255), Title of the post  
- `content`: TEXT, Content of the post  
- `created_at`: TIMESTAMP  
- `updated_at`: TIMESTAMP  

### SQL Script:

```sql
CREATE DATABASE IF NOT EXISTS blog_db;
USE blog_db;

CREATE TABLE IF NOT EXISTS posts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
````

---

## Installation Steps

1. Install XAMPP: [https://www.apachefriends.org](https://www.apachefriends.org)
2. Start Apache and MySQL in the XAMPP control panel
3. Copy `blog_crud` folder into `htdocs` directory
4. Open `http://localhost/phpmyadmin`, create `blog_db`, and import `crud_db.sql`
5. Access app via `http://localhost/blog_crud/index.php`

---

## Usage Guide

* View blog posts on the main page (`index.php`)
* Click "Add New Post" to create a new blog post
* Use "Edit" to modify posts
* Use "Delete" to remove posts

---

## Future Enhancements

* User login/authentication
* Comment system
* Post categories
* Responsive design with Bootstrap
* AJAX for smoother UX

---

## Author

Villanueva, Alsean Phillipe
Revelo, Leijko Gabriel
Barazon, Jhecel Dawn

Created: 2025-05-03