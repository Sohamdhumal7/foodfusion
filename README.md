# FoodFusion — Setup & Run Guide

## Folder Structure

```
foodfusion/
├── index.php                  ← Homepage
├── database.sql               ← Full MySQL schema + sample data
├── README.md                  ← This file
│
├── css/
│   └── main.css               ← All styles (light/dark theme)
│
├── js/
│   └── main.js                ← Dark mode, carousel, modals, cookies
│
├── includes/
│   ├── db.php                 ← PDO database connection
│   ├── auth.php               ← Session helpers, CSRF
│   ├── header.php             ← Navbar (shared across pages)
│   ├── footer.php             ← Footer + Join Us modal + Cookie banner
│   └── logout.php             ← Logout handler
│
├── pages/
│   ├── login.php              ← Login with lockout after 3 failed attempts
│   ├── register.php           ← Registration with bcrypt hashing
│   ├── about.php              ← About Us
│   ├── recipes.php            ← Recipe Collection with filters
│   ├── community.php          ← Community Cookbook (submit + view)
│   ├── contact.php            ← Contact form (saves to DB)
│   ├── resources.php          ← Culinary Resources (PDFs, tutorials, videos)
│   ├── educational.php        ← Educational Resources (sustainability, energy)
│   ├── privacy.php            ← Privacy Policy
│   └── cookies.php            ← Cookie Policy
│
└── uploads/
    └── recipes/               ← Future: user-uploaded recipe images
```

---

## Step-by-Step Setup (XAMPP)

### Step 1 — Install XAMPP

1. Download XAMPP from https://www.apachefriends.org
2. Install it (default location: `C:\xampp` on Windows, `/Applications/XAMPP` on Mac)
3. Open **XAMPP Control Panel**
4. Click **Start** next to **Apache**
5. Click **Start** next to **MySQL**
6. Both should show green "Running" status

---

### Step 2 — Copy the Project Files

**Windows:**
```
Copy the entire `foodfusion` folder into:
C:\xampp\htdocs\foodfusion
```

**Mac / Linux:**
```
Copy the entire `foodfusion` folder into:
/Applications/XAMPP/htdocs/foodfusion
```

The result should be:
```
C:\xampp\htdocs\foodfusion\index.php        ← you should see this file
C:\xampp\htdocs\foodfusion\database.sql
C:\xampp\htdocs\foodfusion\css\main.css
... etc
```

---

### Step 3 — Create the Database

**Option A — phpMyAdmin (Recommended for beginners)**

1. Open your browser and go to: http://localhost/phpmyadmin
2. Click **"New"** in the left sidebar
3. Type `foodfusion` as the database name
4. Select **utf8mb4_unicode_ci** as collation
5. Click **Create**
6. Click the new `foodfusion` database in the left sidebar
7. Click the **SQL** tab at the top
8. Open the file `foodfusion/database.sql` in a text editor (Notepad, VS Code, etc.)
9. Copy ALL the contents
10. Paste into the SQL box in phpMyAdmin
11. Click **Go**
12. You should see a success message and the tables will appear in the left panel

**Option B — MySQL Command Line**

```bash
# Open a terminal / command prompt
cd C:\xampp\mysql\bin        # Windows
# OR
cd /Applications/XAMPP/bin   # Mac

# Connect to MySQL
mysql -u root -p
# (Press Enter if no password)

# Run these commands:
source C:/xampp/htdocs/foodfusion/database.sql
# OR on Mac/Linux:
source /Applications/XAMPP/htdocs/foodfusion/database.sql

exit
```

---

### Step 4 — Configure Database Connection

Open `foodfusion/includes/db.php` and check these settings:

```php
define('DB_HOST', 'localhost');   // Usually 'localhost' — do not change
define('DB_NAME', 'foodfusion');  // Must match the database you created
define('DB_USER', 'root');        // Default XAMPP username
define('DB_PASS', '');            // Default XAMPP password is empty — leave blank
```

> ⚠️ **If your MySQL has a password**, update `DB_PASS` to match.

---

### Step 5 — Run the Application

1. Make sure Apache and MySQL are both **Running** in XAMPP Control Panel
2. Open your browser
3. Go to: **http://localhost/foodfusion/**
4. You should see the FoodFusion homepage!

---

## Testing the Features

### Test Registration & Login

1. Go to http://localhost/foodfusion/pages/register.php
2. Fill in your name, email, and a password (min. 8 characters)
3. Click "Create Account"
4. You'll be redirected to the login page
5. Log in with your credentials
6. Your name will appear in the navbar

### Test Account Lockout

1. Go to http://localhost/foodfusion/pages/login.php
2. Enter a valid email but **wrong password** 3 times in a row
3. On the 3rd failed attempt, you'll see a lockout message
4. The account unlocks automatically after **3 minutes**

### Test Community Cookbook

1. Log in first
2. Go to http://localhost/foodfusion/pages/community.php
3. Fill in the recipe form and submit
4. Your recipe will appear in the list below

### Test Contact Form

1. Go to http://localhost/foodfusion/pages/contact.php
2. Fill in all fields and submit
3. Open phpMyAdmin → foodfusion → contact_messages table to see it saved

### Test Dark Mode

1. On any page, click the **moon icon** 🌙 in the top-right navbar
2. The entire site switches to dark mode
3. Refresh the page — your preference is remembered (localStorage)

### Test Cookie Banner

1. Open a browser where you haven't accepted cookies yet
2. OR open **Incognito/Private** mode and go to http://localhost/foodfusion/
3. The cookie banner will slide up from the bottom after ~1.2 seconds
4. Click "Accept All" or "Decline"

### Test Recipe Filters

1. Go to http://localhost/foodfusion/pages/recipes.php
2. Click any cuisine or difficulty filter button
3. Recipes filter instantly without a page reload

---

## Database Tables Overview

| Table | Purpose |
|---|---|
| `users` | Stores registered user accounts (with hashed passwords & lockout info) |
| `recipes` | Curated/admin recipes shown in the Recipe Collection |
| `community_recipes` | User-submitted recipes for the Community Cookbook |
| `contact_messages` | Messages submitted via the Contact Us form |

---

## Security Features Implemented

| Feature | Implementation |
|---|---|
| Password hashing | `password_hash($pw, PASSWORD_BCRYPT, ['cost'=>12])` |
| Login lockout | After 3 failed attempts → locks for 3 minutes via `locked_until` DB column |
| SQL Injection prevention | All queries use **PDO Prepared Statements** |
| CSRF Protection | All forms include a `csrf_token` validated server-side |
| Input validation | `htmlspecialchars()` on all output; `filter_var()` for emails |
| Session management | PHP sessions with `session_start()` checks |

---

## Common Troubleshooting

| Problem | Solution |
|---|---|
| Blank page | Enable PHP error display: add `ini_set('display_errors',1);` to top of `index.php` temporarily |
| "Database connection failed" | Check that MySQL is running in XAMPP and `db.php` credentials are correct |
| CSS/JS not loading | Make sure the path is `/foodfusion/css/main.css` — the folder must be named exactly `foodfusion` |
| Images not showing | These use Unsplash URLs and require an internet connection |
| 404 on pages | Ensure Apache is running and you're visiting `http://localhost/foodfusion/` |
| phpMyAdmin won't open | Try http://127.0.0.1/phpmyadmin instead of localhost |

---

## Recommended Word Count Note (for Assignment)

The **Task 5 Reflection** (1,000 words) should be written separately in your Word document. Use screenshots of the running application alongside the ERD diagram from the database schema.

**ERD Summary for your diagram:**
```
users (id PK) ──< community_recipes (user_id FK → users.id)
recipes (id PK)  [standalone curated table]
contact_messages (id PK) [standalone]
```
