# CityU-Student-Housing-System

## 📋 Overview

A web-based housing management platform designed specifically for CityU mainland Chinese students. This traditional PHP page-style system addresses key rental challenges by providing efficient solutions for housing information management, roommate matching, and streamlined property listing.

### Key Features:
- **For Students**: Advanced search/filtering, roommate matching, simplified property selection
- **For Landlords**: Intuitive listing management, tenant communication tools
- **System Benefits**: Reduces information asymmetry, bridges supply-demand gaps, enhances campus housing market efficiency

## 🚀 Quick Start

### Prerequisites
- PHP development environment (phpStudy or similar)
- Code editor (Sublime Text 3 or similar)
- Database management tool (Navicat 11 or phpMyAdmin)

### Installation Steps

1. **Project Setup**
   - Create a folder named `phpzfxt` in your web server's document root
   - Copy all project files into the `phpzfxt` folder

2. **Start Web Services**
   - Open your PHP development environment (e.g., phpStudy)
   - Start Apache and MySQL services

3. **Access the Application**
   - Once services are running
   - Open the web browser
   - Navigate to: `http://localhost/phpzfxt/`

4. **Login Credentials**
   - Use the default admin credentials:
     - **Username**: `admin`
     - **Password**: `admin`

## 🏗️ Architecture

### Core Structure
```
phpzfxt/
├── include/                  # Core libraries
│   ├── class/               # Class files
│   ├── common.php           # Common functions
│   └── info.php             # Static methods
├── upload/                  # File storage
├── *.php                    # Module files
└── 数据库.sql             # Database schema
```

### Module Pattern
- `module_name.php` - Main processor
- `module_name_list.php` - Backend listing
- `module_name_add.php` - Backend add
- `module_name_updt.php` - Backend update
- `module_namelist.php` - Frontend listing
- `module_nameadd.php` - Frontend add
- `module_namedetail.php` - Details page

### Key Components
- `action.php` - Login handler, batch operations, password change
- `ajax.php` - AJAX request handler
- `checkLogin.php` - Authentication verification and session timeout
- `conn.php` - Database configuration (MySQLi)
- `initialize.php` - PHP initialization and constants definition
- `image.php` - Captcha generator (GD2 + session + random)
- `upload.php` - File upload processor
- `upload.html` - File upload interface via Layer popup
- `mod.php` - Password modification page
- `sy.php` - Backend dashboard homepage

## 🛠️ Features

### Core Functionality
- User Management: Registration, authentication, role-based access
- Property Management: Listings, categorization, image galleries
- Rental Operations: Lease agreements, applications
- Communication System: Private messaging, comments, notifications
- Administrative Tools: Full CRUD operations, audit logs, batch processing

### Technical Stack
- **Frontend**: Bootstrap 3, jQuery, jQuery.validate, Layer popups
- **Backend**: PHP page-based architecture, MySQLi, custom ORM
- **Security**: Input validation, SQL injection prevention
- **File Handling**: Upload system with MIME type validation
- **Authentication**: Session-based login with captcha verification

## 📦 Dependencies

### Server Requirements
- Apache web server
- MySQL database
- PHP with MySQLi extension
- GD2 library for captcha generation

### Frontend Libraries
- Bootstrap 3.0+
- jQuery 1.7+
- jQuery.validate 1.14+
- Layer popup component

## 🔒 Security Features

- Server-side and client-side input validation
- Parameterized queries and SQL escaping via custom Model class
- Captcha verification using GD2 + session + random numbers
- Secure session management with automatic timeout checking
- File upload validation (extension and MIME type checking)
- Role-based access control for different user types
