# 🏥 Midwife Clinic Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12.x">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5.3">
  <img src="https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite">
  <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="MIT License">
</p>

<p align="center">
  A comprehensive, bilingual (English/Indonesian) web-based management system designed specifically for midwife clinics. Built with Laravel 12 and modern web technologies to streamline patient management, transaction tracking, and administrative tasks.
</p>

## ✨ Features

### 🌍 Bilingual Support
- **Full Localization**: Complete English and Bahasa Indonesia support
- **Dynamic Language Switching**: Floating language switcher with session persistence
- **Professional Translation**: Context-aware translations for medical terminology

### 👩‍⚕️ Patient Management
- **Comprehensive Patient Records**: Store complete patient information including NIK, contact details, and medical history
- **Quick Patient Search**: Fast search by name, phone number, or ID
- **Patient Registration**: Streamlined patient onboarding process

### 💰 Transaction Management
- **Service & Medicine Billing**: Integrated billing for medical services and medications
- **Payment Tracking**: Monitor paid/unpaid transactions with detailed status
- **Receipt Generation**: Professional receipt printing functionality
- **Revenue Analytics**: Daily revenue and profit tracking

### 🏥 Medical Services
- **Service Catalog**: Manage available medical services with pricing
- **Medicine Inventory**: Track medication stock levels with low-stock alerts
- **Dynamic Pricing**: Flexible pricing system for services and medications

### 📊 Dashboard & Analytics
- **Real-time Statistics**: Live dashboard with daily patient and revenue metrics
- **Transaction History**: Comprehensive transaction tracking and reporting
- **Quick Actions**: One-click access to common tasks
- **Visual Analytics**: Beautiful charts and statistics cards

### 👨‍💼 Administrative Features
- **Role-based Access**: Admin and staff user roles with appropriate permissions
- **User Management**: Create and manage staff accounts
- **Reports Generation**: Detailed transaction and patient reports
- **System Configuration**: Flexible system settings and preferences

### 🎨 Modern UI/UX
- **Responsive Design**: Mobile-first design that works on all devices
- **Bootstrap 5.3**: Modern, professional interface
- **Interactive Elements**: Smooth animations and transitions
- **Intuitive Navigation**: User-friendly sidebar and navigation system

## 🚀 Quick Start

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM (for asset compilation)
- SQLite (default) or MySQL/PostgreSQL

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/wondrv/midwife-clinic-system.git
   cd midwife-clinic-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate --seed
   ```

6. **Compile assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Open your browser and navigate to `http://localhost:8000`
   - Default admin credentials: `admin@clinic.com` / `password`

## 🏗️ System Architecture

### Technology Stack
- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Blade Templates, Bootstrap 5.3, Font Awesome 6
- **Database**: SQLite (default), MySQL/PostgreSQL support
- **Authentication**: Laravel Breeze
- **Styling**: Custom CSS with Bootstrap integration

### Database Schema
- **Users**: Staff and admin accounts with role-based access
- **Patients**: Comprehensive patient information storage
- **Services**: Medical services catalog with pricing
- **Medicines**: Medication inventory management
- **Transactions**: Billing and payment tracking
- **Relationships**: Proper foreign key relationships for data integrity

### Localization System
- **Translation Files**: Organized translation keys in `lang/en/` and `lang/id/`
- **Middleware**: Automatic locale detection and session management
- **Dynamic Content**: Real-time language switching without page reload

## 📱 Screenshots

### Dashboard
![Dashboard](https://via.placeholder.com/800x400/667eea/ffffff?text=Dashboard+Screenshot)

### Patient Management
![Patient Management](https://via.placeholder.com/800x400/42a5f5/ffffff?text=Patient+Management)

### Transaction System
![Transaction System](https://via.placeholder.com/800x400/66bb6a/ffffff?text=Transaction+System)

## 🔧 Configuration

### Language Configuration
```php
// config/app.php
'locale' => env('APP_LOCALE', 'en'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
```

### Database Configuration
```env
# SQLite (default)
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

# MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=midwife_clinic
DB_USERNAME=root
DB_PASSWORD=
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📚 API Documentation

### Authentication Endpoints
- `POST /login` - User authentication
- `POST /logout` - User logout
- `POST /register` - User registration (admin only)

### Patient Endpoints
- `GET /patients` - List all patients
- `POST /patients` - Create new patient
- `GET /patients/{id}` - Get patient details
- `PUT /patients/{id}` - Update patient
- `DELETE /patients/{id}` - Delete patient

### Transaction Endpoints
- `GET /transactions` - List all transactions
- `POST /transactions` - Create new transaction
- `GET /transactions/{id}` - Get transaction details
- `PATCH /transactions/{id}/mark-paid` - Mark transaction as paid

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write comprehensive tests for new features
- Update documentation for any new functionality
- Ensure translations are complete for both languages

## 📋 Roadmap

- [ ] **Mobile App**: React Native companion app
- [ ] **Advanced Analytics**: Enhanced reporting and analytics dashboard
- [ ] **Appointment Scheduling**: Integrated appointment booking system
- [ ] **SMS Notifications**: Automated patient notifications
- [ ] **Document Management**: Patient document upload and management
- [ ] **Backup System**: Automated database backup functionality
- [ ] **Multi-clinic Support**: Support for multiple clinic locations

## 🐛 Known Issues

- Date formatting in Indonesian locale may need adjustment for regional preferences
- Print functionality requires browser popup permissions
- Large transaction history may impact dashboard loading time

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laravel Framework**: For providing an excellent foundation
- **Bootstrap Team**: For the responsive UI framework
- **Font Awesome**: For the comprehensive icon library
- **Indonesian Medical Community**: For terminology guidance and feedback

## 📞 Support

For support, please open an issue on GitHub or contact:
- **Email**: support@midwifeclinic.com
- **Documentation**: [Wiki](https://github.com/wondrv/midwife-clinic-system/wiki)
- **Issues**: [GitHub Issues](https://github.com/wondrv/midwife-clinic-system/issues)

## 🌟 Star History

If you find this project helpful, please consider giving it a star! ⭐

---

<p align="center">
  Made with ❤️ for the medical community
</p>
