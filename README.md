
##  Project Overview

This project is a full-featured Login  developed for TTunikit

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































CommandDescriptionphp artisan serveStart Laravel development servernpm run devCompile assets (watch mode)npm run buildProduction buildphp artisan migrateRun database migrationscomposer updateUpdate PHP packages
