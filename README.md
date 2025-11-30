<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Hardware Ticketing System - Implementation Guide

## 🚀 Features Implemented

### 1. Dashboard Enhancements ✅
- Ticket status summary with visual progress bars
- Department-wise ticket counts
- Monthly ticket trend charts
- Key metrics: Total, Open, Closed, Late tickets

### 2. Ticket Enquiry DataTable ✅
- **Non-server-side DataTable** implementation
- Advanced filtering by Status, Priority, Department
- Export buttons (Copy, CSV, Excel, PDF, Print)
- Configurable page lengths (50, 100, 200, 500)
- Real-time search across all columns
- Read/unread indicators with badge counts
- Late ticket highlighting

### 3. Image Attachment in Tickets ✅
- Multi-file upload support in ticket creation
- Supported formats: JPG, PNG, GIF, PDF, DOC, DOCX
- Maximum 5MB per file
- Visual preview for images
- Download links for all attachments

### 4. Ticket Assignment Module ✅
**Role-based visibility (hw-admin, hw-subadmin, superadmin only):**
- Assigned To dropdown
- Ticket Status selection
- Expected Time (Hours) field
- Actual Time (Hours) field

### 5. Ticket Reply/Communication Module ✅
- Threaded conversation view
- Reply button in DataTable
- Image/file attachments in replies
- Read/unread indicators
- **Reopen ticket** functionality for closed tickets

**Role-based visibility:**
- **Department Users:** See only their own tickets
- **Hardware Roles:** View all tickets from all departments

### 6. Reporting & Dashboard Metrics ✅
- Monthly reports
- Pending tickets report
- Completed tickets report
- Seeker-wise analysis
- Department-wise analysis
- Assignee-wise performance
- Export functionality (CSV, PDF)

### 7. ntfy.sh Notifications ✅
- New ticket creation notifications
- New reply notifications
- Ticket assignment notifications
- Ticket reopened notifications
- Department-specific routing

## 📋 Prerequisites

- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laravel 11

## 🔧 Installation Steps

### 1. Clone and Setup

```bash
# Clone your repository
git clone <your-repo-url>
cd hardware-ticketing-system

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 2. Database Configuration

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hardware_tickets
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Run Migrations

```bash
# Create the database first
mysql -u root -p
CREATE DATABASE hardware_tickets;
exit;

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed
```

### 4. Storage Setup

```bash
# Create storage link
php artisan storage:link

# Set permissions
chmod -R 775 storage bootstrap/cache
```

### 5. ntfy.sh Configuration

#### Option A: Use Public ntfy.sh (Recommended for testing)

Update `.env`:

```env
NTFY_URL=https://ntfy.sh
NTFY_TOPIC=hardware_tickets_YOUR_UNIQUE_ID
```

**Subscribe to notifications:**
1. Go to https://ntfy.sh
2. Enter your topic name (e.g., `hardware_tickets_YOUR_UNIQUE_ID`)
3. Subscribe via web, mobile app, or curl

#### Option B: Self-hosted ntfy (Recommended for production)

```bash
# Install ntfy server
wget https://github.com/binwiederhier/ntfy/releases/download/v2.8.0/ntfy_2.8.0_linux_amd64.tar.gz
tar -xzf ntfy_2.8.0_linux_amd64.tar.gz
sudo mv ntfy /usr/local/bin/

# Run ntfy
ntfy serve
```

Update `.env`:

```env
NTFY_URL=https://your-ntfy-server.com
NTFY_TOPIC=hardware_tickets
NTFY_USERNAME=your_username
NTFY_PASSWORD=your_password
```

### 6. Build Assets

```bash
# Build for development
npm run dev

# OR build for production
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit: http://localhost:8000

## 👥 User Roles Setup

### Create Test Users with Roles

```bash
php artisan tinker
```

```php
// Create hardware admin
$admin = User::create([
    'name' => 'Hardware Admin',
    'email' => 'admin@hardware.local',
    'password' => bcrypt('password')
]);
$adminRole = Role::where('slug', 'hw-admin')->first();
$admin->roles()->attach($adminRole);

// Create department user
$user = User::create([
    'name' => 'Department User',
    'email' => 'user@dept.local',
    'password' => bcrypt('password')
]);
$userRole = Role::where('slug', 'user')->first();
$user->roles()->attach($userRole);
```

## 🎯 User Access Levels

### Department Users
- Create tickets for their department
- View only their own tickets
- Reply to their own tickets
- Upload attachments

### Hardware Roles (hw-admin, hw-subadmin, superadmin)
- View **all tickets** from all departments
- Assign tickets to technicians
- Update ticket status
- Set expected/actual time
- Reopen closed tickets
- Access all reports
- Manage master data

## 📊 Reports Available

Access via: `/reports`

1. **Monthly Report** - Tickets created in a specific month
2. **Pending Report** - All open tickets ordered by due date
3. **Completed Report** - Closed tickets with date range filter
4. **Seeker-wise Report** - Statistics by ticket creator
5. **Department-wise Report** - Statistics by department
6. **Assignee-wise Report** - Performance metrics by assigned technician

## 🔔 Notification Flow

### New Ticket Created
- Notifies: All hw-admin, hw-subadmin, superadmin users
- Message: "New Ticket #ID: Title"

### New Reply Posted
- From user → Notifies: Assigned technician + all admins
- From admin → Notifies: Ticket creator

### Ticket Assigned
- Notifies: Assigned technician
- Message: "Ticket #ID has been assigned to you"

### Ticket Reopened
- Notifies: Original ticket creator + assigned technician
- Message: "Ticket #ID has been reopened"

## 🔐 File Upload Limits

- Maximum file size: **5MB** per file
- Supported formats: JPG, JPEG, PNG, GIF, PDF, DOC, DOCX
- Multiple files can be uploaded per ticket/reply

## 📱 Mobile Notifications Setup

### Android/iOS
1. Download ntfy app from Play Store/App Store
2. Subscribe to your topic
3. Enable notifications

### Desktop
- Use web interface at https://ntfy.sh
- Or install desktop client

## 🐛 Troubleshooting

### DataTables not loading
```bash
# Reinstall JavaScript dependencies
rm -rf node_modules package-lock.json
npm install
npm run build
```

### Notifications not working
```bash
# Test ntfy connection
curl -d "Test message" https://ntfy.sh/YOUR_TOPIC

# Check Laravel logs
tail -f storage/logs/laravel.log
```

### File uploads failing
```bash
# Check storage permissions
chmod -R 775 storage
php artisan storage:link
```

### Database issues
```bash
# Fresh migration (WARNING: destroys data)
php artisan migrate:fresh --seed
```

## 🎨 Customization

### Change notification topic
Update `.env`:
```env
NTFY_TOPIC=your_custom_topic_name
```

### Modify file upload limits
Edit `config/filesystems.php` and validation rules in controllers.

### Add custom ticket statuses
```bash
php artisan tinker
TicketStatus::create(['name' => 'Your Status', 'inactive' => false]);
```

## 📝 Additional Notes

- The system uses **Tailwind CSS** for styling
- DataTables includes export functionality
- All timestamps are stored in UTC
- Audit trail is maintained for all ticket changes
- Use `.env.example` as reference for configuration

## 🆘 Support

For issues or questions, check:
1. Laravel logs: `storage/logs/laravel.log`
2. Browser console for JavaScript errors
3. Database connection settings
4. File permissions

## 📄 License

This project is proprietary software for internal use.

---

**Version**: 1.0.0  
**Last Updated**: November 2024