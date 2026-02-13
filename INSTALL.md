# DRAKE System - Installation Guide

## Requirements

- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer
- Node.js and NPM (for frontend assets)
- Apache/Nginx web server (or PHP built-in server for development)

## Installation Steps

### 1. Clone the Repository

```bash
git clone https://github.com/priscilaenorthon-dev/Drake3_github.git
cd Drake3_github
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Edit `.env` and configure your database connection:

```
APP_NAME="DRAKE System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=drake_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

Create a MySQL database named `drake_system`:

```sql
CREATE DATABASE drake_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database

```bash
php artisan db:seed
```

This will create:
- Demo tenant
- Default roles (Admin, Manager, User)
- Permissions
- Sample users:
  - Admin: admin@drake.com / password
  - Manager: manager@drake.com / password
- Sample companies, units, positions, teams, collaborators
- Sample schedules and trainings

### 8. Install Frontend Dependencies (Optional)

```bash
npm install
npm run dev
```

### 9. Create Storage Symlink

```bash
php artisan storage:link
```

### 10. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Default Login Credentials

- **Admin User**
  - Email: admin@drake.com
  - Password: password

- **Manager User**
  - Email: manager@drake.com
  - Password: password

## Installation on XAMPP

1. Copy the project folder to `C:\xampp\htdocs\`
2. Start Apache and MySQL from XAMPP Control Panel
3. Create database using phpMyAdmin
4. Configure `.env` file with database credentials
5. Open Command Prompt in project directory
6. Run: `composer install`
7. Run: `php artisan key:generate`
8. Run: `php artisan migrate`
9. Run: `php artisan db:seed`
10. Access: `http://localhost/Drake3_github/public`

## Installation on Linux Server

### Ubuntu/Debian

```bash
# Install PHP and required extensions
sudo apt update
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip unzip

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install MySQL
sudo apt install mysql-server

# Configure MySQL
sudo mysql_secure_installation

# Install and configure project
cd /var/www/html
git clone https://github.com/priscilaenorthon-dev/Drake3_github.git
cd Drake3_github
composer install
cp .env.example .env
php artisan key:generate

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Configure database and run migrations
php artisan migrate
php artisan db:seed
```

### Configure Apache Virtual Host

Create file `/etc/apache2/sites-available/drake.conf`:

```apache
<VirtualHost *:80>
    ServerName drake.local
    DocumentRoot /var/www/html/Drake3_github/public

    <Directory /var/www/html/Drake3_github/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/drake_error.log
    CustomLog ${APACHE_LOG_DIR}/drake_access.log combined
</VirtualHost>
```

Enable site and restart Apache:

```bash
sudo a2ensite drake.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## Troubleshooting

### Permission Issues

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Database Connection Error

- Check MySQL is running
- Verify database credentials in `.env`
- Ensure database exists

### 500 Server Error

- Check `storage/logs/laravel.log`
- Ensure proper file permissions
- Run `php artisan config:clear`
- Run `php artisan cache:clear`

## Next Steps

After installation:

1. Login with admin credentials
2. Configure your tenant settings
3. Create your companies and units
4. Add collaborators
5. Set up work schedules
6. Configure qualifications and trainings

## Support

For issues and questions, please create an issue on GitHub.
