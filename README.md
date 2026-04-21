

**Project for TTunikit**

A modern, responsive Admin Dashboard built with **Laravel** and **Vuexy** Premium Theme.

---

##  Project Overview

This project is a full-featured admin panel developed forTTunikit

---

##  Key Features

- Clean and modern admin interface using **Vuexy** theme
- User Authentication & Authorization
- Responsive design (Desktop + Mobile)
- Dark / Light mode support
- Role & Permission system (ready to extend)
- Database management with Laravel Migrations
- Clean, maintainable, and well-documented code

---

## Tech Stack

| Technology     | Version      |
|----------------|--------------|
| Laravel        | 11.x         |
| PHP            | 8.2+         |
| MySQL          | Latest       |
| Vuexy Theme    | Latest       |
| Node.js        | LTS          |
| XAMPP          | Local Server |

---

##  Local Setup Guide 

### Prerequisites
- XAMPP (Apache + MySQL)
- Composer
- Node.js (LTS version)
- Git

### Step-by-Step Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/Rowan-Tec/TTunikit.git
   cd TTunikit

Install PHP DependenciesBashcomposer install
Install Frontend DependenciesBashnpm install --legacy-peer-deps
Environment SetupBashcp .env.example .env
php artisan key:generate
Database Setup
Open http://localhost/phpmyadmin
Create new database: Ttunikit_db
Update .env file:envDB_DATABASE=Ttunikit_db
DB_USERNAME=root
DB_PASSWORD=

Run MigrationsBashphp artisan migrate
Compile AssetsBashnpm run dev
Start the Project
Start XAMPP (Apache + MySQL)
Visit: http://localhost/TTunikit/public



Project Structure
Bashmy-vuexy-project/
├── app/                # Models, Policies, Jobs
├── bootstrap/          # App bootstrap
├── config/             # Configuration files
├── database/
│   └── migrations/     # Database tables
├── public/
│   └── assets/         # Vuexy CSS, JS, Images
├── resources/
│   └── views/          # Blade templates
├── routes/             # Web & API routes
├── storage/            # Logs, cache, uploads
└── tests/              # Test files

 Coding & Contribution Guidelines (Must Follow)

Always pull latest code before starting work:Bashgit pull origin main
Create a new branch for every task:Bashgit checkout -b feature/your-task-name
Write clear commit messages.
After finishing your task:Bashgit add .
git commit -m "Add feature: description"
git push origin feature/your-task-name
Create a Pull Request on GitHub for review.





























CommandDescriptionphp artisan serveStart Laravel development servernpm run devCompile assets (watch mode)npm run buildProduction buildphp artisan migrateRun database migrationscomposer updateUpdate PHP packages
