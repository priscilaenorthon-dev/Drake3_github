# Quick Start Guide - DRAKE System

## 🚀 Installation in 5 Minutes

### Prerequisites
- PHP 8.0+ installed
- MySQL 8.0+ installed and running
- Composer installed

### Step 1: Get the Code
```bash
git clone https://github.com/priscilaenorthon-dev/Drake3_github.git
cd Drake3_github
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database:
```
DB_DATABASE=drake_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 4: Setup Database
```bash
# Create the database (MySQL command)
mysql -u root -p -e "CREATE DATABASE drake_system"

# Run migrations and seed data
php artisan migrate
php artisan db:seed
```

### Step 5: Start the Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## 🔐 Login Credentials

### Administrator Account
- Email: `admin@drake.com`
- Password: `password`
- Access: Full system access

### Manager Account
- Email: `manager@drake.com`
- Password: `password`
- Access: Operational access

## 📊 What You'll See

### Dashboard (http://localhost:8000/dashboard)
After login, you'll see:
- **4 KPI Cards**: Schedules, Trainings, Approvals, Collaborators
- **Today's Work Schedules**: List of scheduled workers
- **Expiring Trainings**: Upcoming training expirations
- **Pending Approvals**: Vacation and travel requests

### Companies (http://localhost:8000/companies)
- View ACME Corporation (demo company)
- Create new companies
- Edit/Delete companies
- View company details

### Navigation Menu
- Dashboard
- Companies
- Collaborators
- Work Schedules
- Trainings
- Compliance
- Logistics
- HR
- Operations
- Reports

## 🎯 Demo Data Included

After seeding, you'll have:
- 1 Company: ACME Corporation
- 2 Units: Plataforma Alpha, Base Logística
- 2 Locations
- 2 Job Positions
- 1 Team
- 2 Work Shifts (Day/Night)
- 2 Collaborators: João Silva, Maria Santos
- 14 Work Schedules (next 7 days)
- 2 Safety Qualifications (NR-10, NR-35)
- 2 Training Courses
- 2 Training Records

## 🛠️ Common Tasks

### Add a New Company
1. Go to Companies → New Company
2. Fill in company details
3. Click Save

### View Schedules
1. Go to Work Schedules
2. See who's working when
3. Filter by date/collaborator

### Check Training Status
1. Go to Trainings
2. View expiring trainings
3. Check compliance status

### Manage Users
1. Go to Users (Admin only)
2. Create new users
3. Assign roles

## 🔧 Troubleshooting

### "Connection Refused" Error
**Problem**: Can't connect to database
**Solution**: 
```bash
# Check MySQL is running
sudo systemctl status mysql  # Linux
# OR check XAMPP Control Panel (Windows)

# Verify credentials in .env file
```

### "No Application Key" Error
**Problem**: Application key not set
**Solution**:
```bash
php artisan key:generate
```

### "Permission Denied" Error
**Problem**: File permission issues
**Solution**:
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Can't Login
**Problem**: Wrong credentials or database not seeded
**Solution**:
```bash
# Re-seed the database
php artisan migrate:fresh --seed

# Use credentials: admin@drake.com / password
```

## 📱 Features Tour

### Multi-Tenant System
- Each tenant has isolated data
- Switch between tenants (future feature)
- Tenant-specific configurations

### Role-Based Access
- Admin sees everything
- Manager sees operational features
- User sees limited features
- Customizable permissions

### Dashboard Widgets
- **Today's Schedules**: Who's working today
- **Expiring Trainings**: Training renewals needed
- **Pending Approvals**: Items awaiting approval
- **Active Collaborators**: Current workforce count

### Schedule Management
- View daily/weekly schedules
- Assign shifts to collaborators
- Track schedule status
- Approve schedule changes

### Training & Compliance
- Track training completions
- Monitor expiration dates
- Ensure regulatory compliance
- Store certificates

## 🌐 For XAMPP Users

### Installation Path
```
C:\xampp\htdocs\Drake3_github
```

### Access URL
```
http://localhost/Drake3_github/public
```

### Database Setup
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Create database: `drake_system`
3. Import or run migrations

## 🐧 For Linux Users

### Apache Configuration
```bash
sudo nano /etc/apache2/sites-available/drake.conf
```

Add:
```apache
<VirtualHost *:80>
    ServerName drake.local
    DocumentRoot /var/www/html/Drake3_github/public
    <Directory /var/www/html/Drake3_github/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Enable and restart:
```bash
sudo a2ensite drake.conf
sudo systemctl restart apache2
```

Add to `/etc/hosts`:
```
127.0.0.1 drake.local
```

Access: http://drake.local

## 📚 Further Reading

- **Full Installation Guide**: See [INSTALL.md](INSTALL.md)
- **Implementation Details**: See [IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)
- **V2 Features**: See [BACKLOG_V2.md](BACKLOG_V2.md)

## 🎓 Learning Path

### Day 1: Explore the System
- Login as admin
- Navigate all menu items
- View sample data
- Understand the layout

### Day 2: Create Data
- Add a new company
- Create collaborators
- Set up work schedules
- Add qualifications

### Day 3: Understand Workflows
- Create vacation request
- Submit travel request
- Approve/reject requests
- View audit logs

### Day 4: Reports & Analysis
- Generate reports
- Filter data
- Export information
- Analyze trends

## 🤝 Getting Help

### Documentation
1. Read INSTALL.md for setup
2. Check IMPLEMENTATION_SUMMARY.md for details
3. Review Laravel docs: https://laravel.com/docs

### Common Questions

**Q: Can I change the tenant?**
A: Yes, through admin interface (to be implemented)

**Q: How do I add more users?**
A: Login as admin → Users → Create User

**Q: Can I customize permissions?**
A: Yes, edit roles and assign permissions

**Q: Is this production-ready?**
A: It's an MVP. Add more features for production.

## 🔐 Security Notes

⚠️ **Important for Production**:
1. Change default passwords immediately
2. Set strong APP_KEY
3. Use HTTPS only
4. Enable firewall
5. Regular backups
6. Update dependencies regularly

## 📈 Next Steps

After familiarizing yourself with the system:
1. Complete remaining CRUD interfaces
2. Implement approval workflows
3. Add reporting features
4. Customize for your needs
5. Deploy to production
6. Train your users

## 🎉 You're Ready!

The system is now running. Explore the features, add your data, and customize as needed.

**Happy managing! 🚀**
