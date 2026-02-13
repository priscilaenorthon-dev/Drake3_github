# DRAKE System - People and Process Management

A comprehensive web-based system for managing people and processes in complex operations, inspired by DRAKE (Sapiensia).

## Features

### Multi-Tenant SaaS Platform
- Complete tenant isolation with `tenant_id` segregation
- Support for multiple companies under single deployment
- Configurable tenant settings

### Role-Based Access Control (RBAC)
- Flexible roles and permissions system
- Permission assignment by resource and action
- User-role associations
- Built-in roles: Administrator, Manager, User

### Core Modules

#### 1. Base Registrations
- **Companies**: Manage multiple companies with legal information
- **Units/Locations**: Organizational units, bases, platforms
- **Positions**: Job positions and levels
- **Teams**: Work teams with leaders
- **Shifts**: Work shift configurations
- **Collaborators**: Employee/contractor management

#### 2. Work Schedules
- Schedule planning and management
- Shift assignment and tracking
- Schedule status tracking (planned, confirmed, completed)

#### 3. Compliance & Qualifications
- Qualification matrix by position/team/unit
- Training management (online/in-person)
- Training validity and expiration tracking
- Automatic recycling predictions
- Training records with scores and status

#### 4. Additional Modules (Database Ready)
- Logistics: Travel requests, purchase approvals
- HR: Vacation requests, events, timesheets
- Operations: Activities, absences, operational costs

### Dashboard & Reporting
- Real-time KPI indicators
- Today's schedules overview
- Expiring trainings alerts
- Pending approvals summary

## Technology Stack

- **Backend**: PHP 8.3+ / Laravel 10.x
- **Database**: MySQL 8.0
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Authentication**: Laravel UI
- **Architecture**: MVC Pattern

## Installation

See [INSTALL.md](INSTALL.md) for detailed installation instructions.

### Quick Start

```bash
# Clone repository
git clone https://github.com/priscilaenorthon-dev/Drake3_github.git
cd Drake3_github

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Configure database in .env, then:
php artisan migrate
php artisan db:seed

# Start server
php artisan serve
```

### Default Login

- **Admin**: admin@drake.com / password
- **Manager**: manager@drake.com / password

## Project Structure

```
Drake3_github/
├── app/
│   ├── Http/Controllers/     # Controllers for all modules
│   ├── Models/               # Eloquent models
│   └── Traits/               # Reusable traits (BelongsToTenant)
├── database/
│   ├── migrations/           # Database schema
│   └── seeders/              # Sample data
├── resources/
│   └── views/                # Blade templates
├── routes/
│   └── web.php              # Application routes
└── INSTALL.md               # Installation guide
```

## Default Data

The seed process creates:
- Demo tenant with settings
- 3 roles (Admin, Manager, User) with permissions
- 2 sample users
- Sample company "ACME Corporation"
- 2 units (Plataforma Alpha, Base Logística)
- 2 positions, teams, shifts
- 2 sample collaborators
- Sample work schedules and training records

## Security Features

- Multi-tenant data isolation
- RBAC with granular permissions
- Password hashing
- CSRF protection
- SQL injection prevention
- Audit trail logging

## License

Open-source software for demonstration purposes.
