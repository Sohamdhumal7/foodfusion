# FoodFusion

FoodFusion is a responsive recipe and food community website built with PHP, MySQL, HTML, CSS, and JavaScript. It gives users a place to discover recipes, share their own dishes, explore cooking resources, and engage with a community of food lovers through a clean multi-page experience.

## Features

- Responsive design for mobile, tablet, and desktop
- User registration and login system
- Secure password hashing and CSRF protection
- Account lockout after repeated failed login attempts
- Curated recipe collection with filters
- Community cookbook for logged-in users to share recipes
- Contact form with database storage
- Educational and culinary resource pages
- Dark mode toggle with saved preference
- Cookie consent banner
- Embedded video and downloadable resource sections

## Tech Stack

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- XAMPP for local development

## Project Structure

```bash
foodfusion/
├── index.php
├── database.sql
├── README.md
├── css/
│   └── main.css
├── js/
│   └── main.js
├── includes/
│   ├── db.php
│   ├── auth.php
│   ├── header.php
│   ├── footer.php
│   └── logout.php
└── pages/
    ├── about.php
    ├── community.php
    ├── contact.php
    ├── cookies.php
    ├── download_pdf.php
    ├── educational.php
    ├── login.php
    ├── privacy.php
    ├── recipes.php
    ├── register.php
    └── resources.php
```
